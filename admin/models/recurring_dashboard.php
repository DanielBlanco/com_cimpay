<?php
/**
 * @author  Daniel
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import the Joomla modellist library
jimport('joomla.application.component.modellist');

/**
 * Recurring Dashboard Model
 */
class CimpayModelRecurring_dashboard extends JModelList
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

    $tables = '#__cimpay_transactions t,';
    $tables.= '#__cimpay_recurring_services rs,';
    $tables.= '#__cimpay_customers c,';
    $tables.= '#__users u ';

    $customer_select = "c.user_id, u.email as 'user_email', u.name as 'user_name'";
    $service_select = "rs.id as 'service_id', rs.name as 'service_name', rs.months_to_bill as 'service_duration', rs.total_cost as 'service_total_cost'";

    $where = "t.recurring_service_id = rs.id ";
    $where.= "and t.customer_id = c.id ";
    $where.= "and u.id = c.user_id ";
    
    $query->select($customer_select.",".$service_select);
    $query->from($tables);
    $query->where($where);
    $query->group('t.recurring_service_id');

    return $query;
  }

  public function getServiceStatus($service_id) {
    $db = JFactory::getDBO();

    $sql = 'select status from #__cimpay_transactions';
    $sql.= ' where recurring_service_id = '.$service_id;
    $sql.= " and billing_date < '".date('Y-m-d')."'";
    $sql.= ' and status = 0 limit 1,1';
    $db->setQuery($sql);
    $result = $db->loadObject();
    if ($result) {
      return -1;  // Overdue
    } else {
      return 0;   // OK
    }
  }

  public function getMonthsCollected($service_id) {
    $db = JFactory::getDBO();
    $sql = "select sum(recurring_service_months_paid) as 'months_collected' ";
    $sql.= "from p2w85_cimpay_transactions where status = 1 ";
    $sql.= "and recurring_service_id = ".$service_id." ";
    $sql.= "group by recurring_service_id;";
    $db->setQuery($sql);
    $result = $db->loadObject();
    if ($result) {
      return $result->months_collected;
    } else {
      return 0;
    }
  }

  public function getMonthsWithTransaction($service_id) {
    $db = JFactory::getDBO();
    $sql = "select sum(recurring_service_months_paid) as 'months_with_transaction' ";
    $sql.= "from p2w85_cimpay_transactions where ";
    $sql.= "recurring_service_id = ".$service_id." ";
    $sql.= "group by recurring_service_id;";
    $db->setQuery($sql);
    $result = $db->loadObject();
    if ($result) {
      return $result->months_with_transaction;
    } else {
      return 0;
    }
  }
}