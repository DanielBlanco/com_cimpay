<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');
 
/**
 * Recurring Services Table class
 */
class CimpayTableRecurring_services extends JTable
{

  public $id = null;           //INT(11)
  public $name = '';           //VARCHAR(100)
  public $description = '';    //TEXT
  public $active = 1;          //TINYINT(1)
  public $start_at = null;     //VARCHAR(7) => YYYY-MM
  public $months_to_bill = 1;  //INT(11)
  public $total_cost = 0.0000; //DECIMAL(19,4)
  public $tag = '';            //VARCHAR(25)
  public $created_at = null;   //DATETIME
  public $updated_at = null;   //DATETIME

  /**
   * Constructor
   *
   * @param object Database connector object
   */
  function __construct(&$db) 
  {
    parent::__construct('#__cimpay_recurring_services', 'id', $db);
  }

}