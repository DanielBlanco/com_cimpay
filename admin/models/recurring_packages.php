<?php
/**
 * @author  Daniel
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import the Joomla modellist library
jimport('joomla.application.component.modellist');

/**
 * Recurring Packages Model
 */
class CimpayModelRecurring_packages extends JModelList
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
    $query->from('#__cimpay_recurring_packages');
    $query->order('active');

    return $query;
  }
}