<?php
/**
 * @author  Daniel
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import the Joomla modellist library
jimport('joomla.application.component.modellist');

/**
 * Recurring customers Model
 */
class CimpayModelRecurring_customers extends JModelList
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

    $query->select('*');
    $query->select("rc.*, rp.name as 'package_name', c.user_id, u.email as 'user_email', u.name as 'user_name'");
    $query->from('#__cimpay_recurring_customers rc, #__cimpay_recurring_packages rp, #__cimpay_customers c, #__users u');
    $query->where('rc.customer_id = c.id and rc.package_id = rp.id and u.id = c.user_id');

    return $query;
  }
}