<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.model');
 
/**
 * Customer Model
 */
class CimpayModelCustomer extends JModel
{

  protected $userId;
  protected $profileId;
  protected $paymentId;
  protected $shippingId;
 
  /**
   * Returns a reference to the a Table object, always creating it.
   *
   * @param type  The table type to instantiate
   * @param string  A prefix for the table class name. Optional.
   * @param array Configuration array for model. Optional.
   * @return  JTable  A database object
   * @since 2.5
   */
  public function getTable($type = 'Customers', $prefix = 'CimpayTable', $config = array()) 
  {
    return JTable::getInstance($type, $prefix, $config);
  }

  /**
   * 
   */
  public function createCustomerProfile() {
    //$table = $this->getTable();
    //$table->load($id);
    $cimpay = $this->getInstance('cimpay', 'CimpayModel');
    $params = $cimpay->getParams();
    
    $authnetLogin = $params->get('authnet_transaction_key')
    $authnetTransactionKey = $params->get('authnet_transaction_key')
    return AuthnetApi::merchant_authentication_block($authnetLogin, $authnetTransactionKey);
  }
 
  /**
   * Get the user id
   * @return string The user id.
   */
  public function getUserId() 
  {
    if (!isset($this->userId)) 
    {
      $this->userId = 0;      
    }

    return $this->userId;
  }

  /**
   * Get the CIM profile id
   * @return string The CIM profile id.
   */
  public function getProfileId() 
  {
    if (!isset($this->profileId)) 
    {
      //request the selected id
      $id = $this->getRequestId();

      $table = $this->getTable();
      $table->load($id);

      $this->profileId = $table->profile_id;
    }

    return $this->profileId;
  }
 
  /**
   * Get the CIM payment id
   * @return string The CIM payment id.
   */
  public function getPaymentId() 
  {
    if (!isset($this->paymentId)) 
    {
      //request the selected id
      $id = $this->getRequestId();

      $table = $this->getTable();
      $table->load($id);

      $this->paymentId = $table->payment_id;
    }

    return $this->paymentId;
  }

  /**
   * Get the CIM shipping id
   * @return string The CIM shipping id.
   */
  public function getShippingId() 
  {
    if (!isset($this->shippingId)) 
    {
      //request the selected id
      $id = $this->getRequestId();

      $table = $this->getTable();
      $table->load($id);

      $this->shippingId = $table->shipping_id;
    }

    return $this->shippingId;
  }

  /**
   * Requested record ID.
   * @return int id requested.
   */
  public function getRequestId()
  {
    //request the selected id
    $input = JFactory::getApplication()->input;
    return $input->getInt('id');
  }

}