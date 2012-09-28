<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

/**
 * Recurring Package Model
 */
class CimpayModelRecurring_package extends JModel
{
  protected $id = null;           //INT(11)
  protected $service_id = null;   //INT(11)
  protected $name = '';           //VARCHAR(100)
  protected $description = '';    //TEXT
  protected $months_to_pay = 1;   //INT(11)
  protected $recurring = 0;       //TINYINT(1)
  protected $active = 1;          //TINYINT(1)
  protected $discount = 0;        //INT(11)
  protected $created_at = null;   //DATETIME
  protected $updated_at = null;   //DATETIME

  /**
   * Returns a reference to the a Table object, always creating it.
   */
  public function getTable($type = 'Recurring_packages', $prefix = 'CimpayTable', $config = array()) 
  {
    return JTable::getInstance($type, $prefix, $config);
  }

  /**
   * Loads this package model using a record identifier.
   */
  public function load($id)
  {
    $record =& $this->getTable();
    if ($record->load((int)$id)) {
      $this->id = $record->id;
      $this->service_id = $record->service_id;
      $this->name = $record->name;
      $this->description = $record->description;
      $this->months_to_pay = $record->months_to_pay;
      $this->recurring = $record->recurring;
      $this->active = $record->active;
      $this->discount = $record->discount;
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
      'id','service_id','name','description','months_to_pay','recurring',
      'active','discount','created_at','updated_at'
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

  public function destroyDependent() {
        // Create a new query object.
    $db = JFactory::getDBO();
    $query = $db->getQuery(true);

    /*$query->delete('*');
    $query->select("rc.*, rp.name as 'package_name', c.user_id, u.email as 'user_email', u.name as 'user_name'");
    $query->from('#__cimpay_recurring_customers rc, #__cimpay_recurring_packages rp, #__cimpay_customers c, #__users u');
    $query->where('rc.customer_id = c.id and rc.package_id = rp.id and u.id = c.user_id');

    return $query;*/
  }

  public function getId() {
    return (int)$this->id;
  }
  public function setId($value) {
    $this->id = $value;
  }
  public function getServiceId() {
    return (int)$this->service_id;
  }
  public function setServiceId($value) {
    $this->service_id = $value;
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
  public function getMonthsToPay() {
    $mtb = (int)$this->months_to_pay;
    return ($mtb <= 0 ? 0 : $mtb);
  }
  public function setMonthsToPay($value) {
    if ($value <= 0) {
      $value = 1;
    }
    $this->months_to_pay = $value;
  }
  public function getRecurring() {
    return (int)$this->recurring;
  }
  public function setRecurring($value) {
    $this->recurring = $value;
  }
  public function isRecurring() {
    return $this->recurring == 1;
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
  public function getDiscount() {
    return $this->discount;
  }
  public function setDiscount($value) {
    $this->discount = $value;
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