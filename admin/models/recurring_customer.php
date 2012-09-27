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
  public function save() {
    $record =& $this->getTable();
    $props = array(
      'id','customer_id','package_id','months_paid','created_at','updated_at'
    );
    foreach ($props as $var) {
      $record->$var = $this->$var;
    }
    return $record->store();
  }

  /**
   * Destroy the received records.
   */
  public function destroy($ids) {
    $record =& $this->getTable();
    foreach($ids as $id) {
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