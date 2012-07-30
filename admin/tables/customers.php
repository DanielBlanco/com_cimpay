<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');
 
/**
 * Cimpay Table class
 */
class CimpayTableCustomers extends JTable
{

  public $id = null;
  public $user_id = null;
  public $profile_id = '';
  public $payment_id = '';
  public $shipping_id = '';

  /**
   * Constructor
   *
   * @param object Database connector object
   */
  function __construct(&$db) 
  {
    parent::__construct('#__cimpay_customers', 'id', $db);
  }

  /**
   * Load a record using the user_id as key.
   */
  public function load_by_user_id($user_id) {
    $this->user_id = $user_id;
    return $this->load(array('user_id'=>$user_id));
  }
}