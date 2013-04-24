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

    $query->select("rp.*, rs.name as 'service_name', rs.description as 'service_description', rs.months_to_bill, rs.total_cost");
    $query->from('#__cimpay_recurring_packages rp, #__cimpay_recurring_services rs');
    $query->where('rp.service_id = rs.id and rp.active = 1 and rs.active = 1');
    $query->order('rs.name, rp.name');

    return $query;
  }

  public function getPackagesFilteredByTag($tag='') 
  {

    // Create a new query object.
    $db = JFactory::getDBO();
    $query = $db->getQuery(true);

    $query->select("rp.*, rs.name as 'service_name', rs.description as 'service_description', rs.months_to_bill, rs.total_cost");
    $query->from('#__cimpay_recurring_packages rp, #__cimpay_recurring_services rs');
    $query->where("rp.service_id = rs.id and rp.active = 1 and rs.active = 1 and rs.tag REGEXP '[[:<:]]".$tag."[[:>:]]'");
    $query->order('rs.id, rp.id');

    $items  = $this->_getList($query, $this->getStart(), $this->getState('list.limit'));

    // Check for a database error.
    if ($this->_db->getErrorNum()) {
      $this->setError($this->_db->getErrorMsg());
      return false;
    }

    return $items;
  }

}