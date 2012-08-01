<?php
/**
 * @author  Daniel
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import the Joomla modellist library
jimport('joomla.application.component.modellist');

require_once(dirname(__FILE__) . '/../lib/authnet_api.php'); 

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
    // Create a new query object.
    $db = JFactory::getDBO();
    $query = $db->getQuery(true);

    $query->select('u.email, u.name, t.*');
    $query->from('#__cimpay_transactions t, #__cimpay_customers c, #__users u');
    $query->where('u.id = c.user_id and c.id = t.customer_id');
    $query->order('t.status');

    return $query;
  }

  /**
   * Collect the table dues.
   */
  public function collectDues()
  {
    $params =& JComponentHelper::getParams('com_cimpay');

    $api = new AuthnetApi();
    $api->authnet_login = $params->get('authnet_login', 'no-login');
    $api->authnet_transaction_key = $params->get('authnet_transaction_key', 'no-key');
    $api->authnet_api_host = $params->get('authnet_api_host', 'apitest.authorize.net');
    $api->authnet_api_path = $params->get('authnet_api_path', '/xml/v1/request.api');

    $db = JFactory::getDBO();
    $query = $db->getQuery(true);
    $query->select('t.*, c.profile_id, c.payment_id, c.shipping_id');
    $query->from('#__cimpay_transactions t, #__cimpay_customers c');
    $query->where("c.id = t.customer_id and t.status = 0 and t.billing_date <= '".date('Y-m-d')."'");
    $db->setQuery($query);
    $result = $db->loadAssocList();

    foreach ($result as $row) {
      $row = (object)$row;
      $api->customer_profile_id = $row->profile_id;
      $api->customer_payment_id = $row->payment_id;
      $api->customer_address_id = $row->shipping_id;

      if ($api->create_transaction($row)) {
        $sql = "UPDATE #__cimpay_transactions SET status = 1, log_message = '' where id = ".$row->id;
        $db->setQuery($sql);
        $result = $db->query();
      } else {
        $sql = "UPDATE #__cimpay_transactions SET log_message = '".$api->errors[0]."' where id = ".$row->id;
        $db->setQuery($sql);
        $result = $db->query();
      }
    }

    return true;
  }
}