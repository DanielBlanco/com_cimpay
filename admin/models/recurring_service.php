<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

require_once(dirname(__FILE__) . '/../lib/authnet_api.php'); 

/**
 * Recurring Service Model
 */
class CimpayModelRecurring_service extends JModel
{
  protected $id = null;           //INT(11)
  protected $name = '';           //VARCHAR(100)
  protected $description = '';    //TEXT
  protected $active = 1;          //TINYINT(1)
  protected $start_at = null;     //VARCHAR(7) => YYYY-MM
  protected $months_to_bill = 1;  //INT(11)
  protected $total_cost = 0.0000; //DECIMAL(19,4)
  protected $tag = '';            //VARCHAR(25)
  protected $created_at = null;   //DATETIME
  protected $updated_at = null;   //DATETIME

  /**
   * Returns a reference to the a Table object, always creating it.
   */
  public function getTable($type = 'Recurring_services', $prefix = 'CimpayTable', $config = array()) 
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
      $this->name = $record->name;
      $this->description = $record->description;
      $this->active = $record->active;
      $this->start_at = $record->start_at;
      $this->months_to_bill = $record->months_to_bill;
      $this->total_cost = $record->total_cost;
      $this->tag = $record->tag;
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
      'id','name','description','active','start_at','months_to_bill',
      'total_cost','tag','created_at','updated_at'
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
  public function getName() {
    return $this->name;
  }
  public function setName($value) {
    $this->name = $value;
  }
  public function getDescription() {
    return $this->description;
  }
  public function setDescription($value) {
    $this->description = $value;
  }
  public function getActive() {
    return (int)$this->active;
  }
  public function setActive($value) {
    $this->active = $value;
  }
  public function isActive() {
    return $this->active == 1;
  }
  public function getStartAt() {
    if ($this->start_at == null) {
      $this->start_at = date('Y-m');
    }
    return $this->start_at;
  }
  public function setStartAt($value) {
    if (strlen($value) != 7) {
      $this->start_at = date('Y-m');
    } else {
      $this->start_at = $value;
    }
  }
  public function getMonthsToBill() {
    $mtb = (int)$this->months_to_bill;
    return ($mtb <= 0 ? 0 : $mtb);
  }
  public function setMonthsToBill($value) {
    if ($value <= 0) {
      $value = 1;
    }
    $this->months_to_bill = $value;
  }
  public function getTotalCost() {
    return $this->total_cost;
  }
  public function setTotalCost($value) {
    $this->total_cost = $value;
  }
  public function getTag() {
    return $this->tag;
  }
  public function setTag($value) {
    $this->tag = $value;
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