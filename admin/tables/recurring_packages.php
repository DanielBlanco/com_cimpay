<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');
 
/**
 * Recurring Packages Table class
 */
class CimpayTableRecurring_packages extends JTable
{

  public $id = null;           //INT(11)
  public $service_id = null;   //INT(11)
  public $name = '';           //VARCHAR(100)
  public $description = '';    //TEXT
  public $months_to_pay = 1;   //INT(11)
  public $recurring = 0;       //TINYINT(1)
  public $active = 1;          //TINYINT(1)
  public $discount = 0;        //INT(11)
  public $created_at = null;   //DATETIME
  public $updated_at = null;   //DATETIME

  /**
   * Constructor
   *
   * @param object Database connector object
   */
  function __construct(&$db) 
  {
    parent::__construct('#__cimpay_recurring_packages', 'id', $db);
  }

}