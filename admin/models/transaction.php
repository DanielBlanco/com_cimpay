<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

require_once(dirname(__FILE__) . '/../lib/authnet_api.php'); 

/**
 * Transaction Model
 */
class CimpayModelTransaction extends JModel
{

  protected $id = null;
  protected $status = 0;
  protected $customer_id = null;
  protected $amount = '';
  protected $shipping_amount = '';
  protected $shipping_name = '';
  protected $shipping_description = '';
  protected $item_id = '';
  protected $item_name = '';
  protected $item_description = '';
  protected $item_quantity = 1;
  protected $item_unit_price = '';
  protected $order_invoice_number = '';
  protected $billing_date = '';
  protected $log_message = '';
  protected $recurring_customer_plan = null;

  /**
   * Returns a reference to the a Table object, always creating it.
   */
  public function getTable($type = 'Transactions', $prefix = 'CimpayTable', $config = array()) 
  {
    return JTable::getInstance($type, $prefix, $config);
  }

  /**
   * Save the record.
   */
  public function save() {
    $record =& $this->getTable();
    $props = array(
      'id','status','customer_id','amount','shipping_amount','shipping_name',
      'shipping_description','item_id','item_name','item_description',
      'item_quantity','item_unit_price','order_invoice_number', 'billing_date',
      'log_message', 'recurring_customer_plan'
    );
    foreach ($props as $var) {
      $record->$var = $this->$var;
    }
    return $record->store();
  }

  public function getId() {
    return (int)$this->id;
  }
  public function setId($value) {
    $this->id = $value;
  }

  public function getStatus() {
    return (int)$this->status;
  }
  public function setStatus($value) {
    $this->status = $value;
  }
  public function isPending() {
    return $this->status == 0;
  }
  public function isProcessed() {
    return $this->status == 1;
  }

  public function getCustomerId() {
    return (int)$this->customer_id;
  }
  public function setCustomerId($value) {
    $this->customer_id = $value;
  }

  public function getAmount() {
    return $this->amount;
  }
  public function setAmount($value) {
    $this->amount = $value;
  }

  public function getShippingAmount() {
    return $this->shipping_amount;
  }
  public function setShippingAmount($value) {
    $this->shipping_amount = $value;
  }

  public function getShippingName() {
    return $this->shipping_name;
  }
  public function setShippingName($value) {
    $this->shipping_name = $value;
  }

  public function getShippingDescription() {
    return $this->shipping_description;
  }
  public function setShippingDescription($value) {
    $this->shipping_description = $value;
  }

  public function getItemId() {
    return $this->item_id;
  }
  public function setItemId($value) {
    $this->item_id = $value;
  }

  public function getItemName() {
    return $this->item_name;
  }
  public function setItemName($value) {
    $this->item_name = $value;
  }

  public function getItemDescription() {
    return $this->item_description;
  }
  public function setItemDescription($value) {
    $this->item_description = $value;
  }

  public function getItemQuantity() {
    return $this->item_quantity;
  }
  public function setItemQuantity($value) {
    $value = (int)$value;
    if ($value < 1) {
      $value = 1;
    }
    $this->item_quantity = $value;
  }

  public function getItemUnitPrice() {
    return $this->item_unit_price;
  }
  public function setItemUnitPrice($value) {
    $this->item_unit_price = $value;
  }
 
  public function getOrderInvoiceNumber() {
    return $this->order_invoice_number;
  }
  public function setOrderInvoiceNumber($value) {
    $this->order_invoice_number = $value;
  }

  public function getBillingDate() {
    return $this->billing_date;
  }
  public function setBillingDate($value) {
    if (strlen($value) != 10) {
      $value = (String)date('Y-m-d');
    }
    $this->billing_date = $value;
  }

  public function getLogMessage() {
    return $this->log;
  }
  public function setLogMessage($value) {
    $this->log = $value;
  }
  public function getRecurringCustomerPlan() {
    return $this->recurring_customer_plan;
  }
  public function setRecurringCustomerPlan($value) {
    $this->recurring_customer_plan = $value;
  }
}