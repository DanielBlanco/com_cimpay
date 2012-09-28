<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');
 
/**
 * Recurring customers Table class
 */
class CimpayTableRecurring_customers extends JTable
{

  public $id = null;           //INT(11)
  public $customer_id = null;  //INT(11)
  public $package_id = null;   //VARCHAR(100)
  public $months_paid = 0;     //INT(11)
  //public $active = 1;          //TINYINT(1)
  public $created_at = null;   //DATETIME
  public $updated_at = null;   //DATETIME

  /**
   * Constructor
   *
   * @param object Database connector object
   */
  function __construct(&$db) 
  {
    parent::__construct('#__cimpay_recurring_customers', 'id', $db);
  }
}