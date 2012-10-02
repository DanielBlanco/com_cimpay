<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

/**
 * Recurring Customer Model
 */
class CimpayModelRecurring_customer extends JModel
{
  protected $id = null;           //INT(11)
  protected $customer_id = null;  //INT(11)
  protected $package_id = null;   //INT(11)
  protected $months_paid = 0;     //INT(11)
  protected $created_at = null;   //DATETIME
  protected $updated_at = null;   //DATETIME

  /**
   * Returns a reference to the a Table object, always creating it.
   */
  public function getTable($type = 'Recurring_customers', $prefix = 'CimpayTable', $config = array()) 
  {
    return JTable::getInstance($type, $prefix, $config);
  }

  /**
   * Loads this customer model using a record identifier.
   */
  public function load($id)
  {
    $record =& $this->getTable();
    if ($record->load((int)$id)) {
      $this->id = $record->id;
      $this->customer_id = $record->customer_id;
      $this->package_id = $record->package_id;
      $this->months_paid = $record->months_paid;
      $this->created_at = $record->created_at;
      $this->updated_at = $record->updated_at;
    }
  }

  /**
   * Save the record.
   */
  public function save($skip_update = false) {
    if ($this->id) {
      if ($skip_update) {
        return true;
      } else {
        $this->destroy(array($id));
      }
    }

    $record =& $this->getTable();
    $props = array(
      'id','customer_id','package_id','months_paid','created_at','updated_at'
    );

    foreach ($props as $var) {
      $record->$var = $this->$var;
    }
    $stored = $record->store();
    if ($stored) {
      $this->id = $record->id;
      $this->createTransactions();
    }
    return $stored;
  }

  public function createTransactions() {
    $db = JFactory::getDBO();
    $query = $db->getQuery(true);
    $query->select("rc.id, rc.customer_id, c.user_id, rc.package_id, rs.id as 'service_id', rp.name as 'package_name', rp.description as 'package_description', rp.months_to_pay, rp.recurring, rp.discount, rs.name as 'service_name', rs.description as 'service_description', rs.start_at, rs.months_to_bill, rs.total_cost");
    $query->from('#__cimpay_recurring_customers rc, #__cimpay_recurring_packages rp, #__cimpay_recurring_services rs , #__cimpay_customers c, #__users u');
    $query->where('rc.customer_id = c.id and rc.package_id = rp.id and rp.service_id = rs.id and u.id = c.user_id and rc.id = '.$this->id);
    $db->setQuery($query);
    $result = $db->loadObject();

    if ($result) {

      $recurring_customer_plan = $result->id;

      # Service
      $service_id = $result->service_id;
      $service_name = $result->service_name;
      $service_description = $result->service_description;
      $months_to_bill = $result->months_to_bill;
      $start_at = $result->start_at;
      $total_cost = $result->total_cost;
      $cost_per_month = ($total_cost / $months_to_bill);
      $discount = $result->discount;

      # Package
      $package_id = $result->package_id;
      $months_to_pay = $result->months_to_pay;
      $discount = ($cost_per_month * ($discount/100));
      $recurring = $result->recurring; //0:No, 1:Yes


      if ($months_to_pay > 0) {
        $transaction_num = 1;
        $months_paid = $months_to_bill;
        if ($recurring != 0 && $months_to_pay <= $months_to_bill) {
          $transaction_num = floor($months_to_bill / $months_to_pay);
          $months_paid = $transaction_num * $months_to_pay;
        }

        $db->setQuery("select next_invoice_number from #__cimpay;");
        $result = $db->loadObject();
        $next_invoice_number = $result->next_invoice_number;

        $sql = "INSERT INTO #__cimpay_transactions (";
        $sql.= "customer_id, amount, shipping_amount, shipping_name, shipping_description,";
        $sql.= "item_id, item_name, item_description, item_quantity, item_unit_price,";
        $sql.= "item_taxable,order_invoice_number,billing_date,recurring_customer_plan,";
        $sql.= "recurring_service_id, recurring_service_months_paid";
        $sql.= ") VALUES ";

        $trans_index = 0;
        while($trans_index < $transaction_num) {
          $customer_id = 1;
          $amount = $cost_per_month - $discount;
          $billing_date = date('Y-m-d', strtotime($start_at.' +'.$trans_index.' month'));

          if ($trans_index > 0) {
            $sql.= ",";          
          }

          $sql.= "(";
          $sql.= $customer_id.",";              //customer_id
          $sql.= $amount.",";                   //amount
          $sql.= "0,";                          //shipping_amount
          $sql.= "'No Shipping',";              //shipping_name
          $sql.= "'No Shipping',";              //shipping_description
          $sql.= $service_id.",";               //item_id
          $sql.= "'".$service_name."',";        //item_name
          $sql.= "'".$service_description."',"; //item_description
          $sql.= "1,";                          //item_quantity
          $sql.= $amount.",";                   //item_unit_price
          $sql.= "0,";                          //item_taxable
          $sql.= "'".$next_invoice_number."',"; //order_invoice_number
          $sql.= "'".$billing_date."',";        //billing_date
          $sql.= $recurring_customer_plan.",";  //recurring_customer_plan
          $sql.= $service_id.',';               //recurring_service_id
          $sql.= $months_to_pay;                //recurring_service_months_paid
          $sql.= ")";

          $next_invoice_number++;
          $trans_index++;
        }
        $sql.= ";";
        $db->setQuery($sql);
        $result = $db->query();
        if (!$result) {
          JError::raiseWarning(100, $db->getErrorMsg());
        } else {
          // Update the next_invoice_number column.
          $sql = "update #__cimpay set next_invoice_number = ".$next_invoice_number.";";
          $db->setQuery($sql);
          $result = $db->query();
          if (!$result) {
            JError::raiseWarning(100, $db->getErrorMsg());
          }
        }

      }
    }
  }

  /**
   * Destroy the received records.
   */
  public function destroy($ids) {
    $db = JFactory::getDBO();
    $record =& $this->getTable();
    foreach($ids as $id) {
      //Destroy the dependent transactions.
      //But do not delete delete collected transactions.
      $sql = "delete from #__cimpay_transactions where status = 0 and recurring_customer_plan = ".$id.";";
      $db->setQuery($sql);
      $result = $db->query();
      if (!$result) {
        $this->setError( $result->getErrorMsg() );
        return false;
      }
      // Remove the associated customer package from collected transactions.
      $sql = "update #__cimpay_transactions set recurring_customer_plan = NULL where recurring_customer_plan = ".$id.";";
      $db->setQuery($sql);
      $result = $db->query();
      if (!$result) {
        $this->setError( $result->getErrorMsg() );
        return false;
      }

      if (!$record->delete($id)) {
        $this->setError( $record->getErrorMsg() );
        return false;
      }
    }
    return true;
  }

  public function getId() {
    return (int)$this->id;
  }
  public function setId($value) {
    $this->id = $value;
  }
  public function getCustomerId() {
    return (int)$this->customer_id;
  }
  public function setCustomerId($value) {
    $this->customer_id = $value;
  }
  public function getPackageId() {
    return (int)$this->package_id;
  }
  public function setPackageId($value) {
    $this->package_id = $value;
  }
  public function getMonthsPaid() {
    return (int)$this->months_paid;
  }
  public function setMonthsPaid($value) {
    $this->months_paid = $value;
  }
  public function getCreatedAt() {
    return $this->created_at;
  }
  public function setCreatedAt() {
    if (!$this->id) {
      $this->created_at = date("Y-m-d H:i:s");
    }
  }
  public function getUpdatedAt() {
    return $this->updated_at;
  }
  public function setUpdatedAt($value='') {
    if (strlen($value) != 10) {
      $this->updated_at = date("Y-m-d H:i:s");
    } else {
      $this->updated_at = date("Y-m-d H:i:s", strtotime($value));
    }
  }
}