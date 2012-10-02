<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');
 
/**
 * Cimpay Table class
 */
class CimpayTableTransactions extends JTable
{

  public $id = null;
  public $status = 0;
  public $customer_id = null;
  public $amount = '';
  public $shipping_amount = '';
  public $shipping_name = '';
  public $shipping_description = '';
  public $item_id = '';
  public $item_name = '';
  public $item_description = '';
  public $item_quantity = 1;
  public $item_unit_price = '';
  public $order_invoice_number = '';
  public $billing_date = '';
  public $log_message = '';
  public $recurring_customer_plan = null;
  public $recurring_service_id = null;
  public $recurring_service_months_paid = 0;

  /**
   * Constructor
   *
   * @param object Database connector object
   */
  function __construct(&$db) 
  {
    parent::__construct('#__cimpay_transactions', 'id', $db);
  }

}