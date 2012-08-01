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
class CimpayModelCustomers extends JModelList
{
  /**
   * Method to build an SQL query to load the list data.
   *
   * @return  string  An SQL query
   */
  protected function getListQuery() 
  {
    // Create a new query object.
    $db = JFactory::getDBO();
    $query = $db->getQuery(true);

    // Select some fields
    $query->select('cc.id, cc.user_id, cc.profile_id, cc.payment_id, cc.shipping_id, u.email, u.name');
    $query->from('#__cimpay_customers cc, #__users u');
    $query->where('u.id = cc.user_id');

    return $query;
  }
}