<?php
/**
 * @author  Daniel
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import the Joomla modellist library
jimport('joomla.application.component.modellist');

/**
 * Customers Model
 */
class CimpayModelTransactions extends JModelList
{
  /**
   * Method to build an SQL query to load the list data.
   *
   * @return  string  An SQL query
   */
  protected function getListQuery() 
  {
    $user=& JFactory::getUser();
    
    // Create a new query object.
    $db = JFactory::getDBO();
    $query = $db->getQuery(true);

    $query->select('u.email, u.name, t.*');
    $query->from('#__cimpay_transactions t, #__cimpay_customers c, #__users u');
    $query->where('u.id = c.user_id and c.id = t.customer_id and c.user_id = '.$user->id);
    $query->order('t.status');

    return $query;
  }

}