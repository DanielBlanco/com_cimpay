<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.model');
require_once(dirname(__FILE__) . '/../lib/authnet_api.php'); 

/**
 * Customer Model
 */
class CimpayModelCustomer extends JModel
{

  protected $id = 0;
  protected $userId = 0;
  protected $profileId = '';
  protected $paymentId = '';
  protected $shippingId = '';

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
   * Create Customer Profile.
   */
  public function createCustomerProfile($arguments, &$errors) {
    $userId = (int)$arguments['user_id'];
    $record =& $this->getTable();
    if (!$record->load_by_user_id($userId)) {
      $record->user_id = $userId;
      if (!$record->store()) {
        $errors[] = $record->getError();
        return false;
      }
    }
    $source = array(
      'id'=>$record->id, 
      'user_id' => $record->user_id,
      'profile_id' => '',
      'payment_id' => '',
      'shipping_id'=> ''
    );

    $app = JFactory::getApplication('site');
    $params = $app->getParams('com_cimpay');
    
    $api = new AuthnetApi();
    $api->authnet_login = $params->get('authnet_login', 'no-login');
    $api->authnet_transaction_key = $params->get('authnet_transaction_key', 'no-key');
    $api->authnet_api_host = $params->get('authnet_api_host', 'apitest.authorize.net');
    $api->authnet_api_path = $params->get('authnet_api_path', '/xml/v1/request.api');
    $api->authnet_validation_mode = $params->get('authnet_validation_mode', 'oldLiveMode');

    $api->customer_id = $userId;
    $api->email = $arguments['email'];
    $api->first_name = $arguments['first_name'];
    $api->last_name = $arguments['last_name'];
    $api->address = $arguments['address'];
    $api->city = $arguments['city'];
    $api->state = $arguments['state'];
    $api->zip = $arguments['zip'];
    $api->country = $arguments['country'];
    $api->phone_number = $arguments['phone_number'];
    $api->cc_card_number = $arguments['cc_card_number'];
    $api->cc_expiration_date = $arguments['cc_expiration_date'];

    if (empty($record->profile_id)) {
      $api->create_customer_profile();
      if (count($api->errors) > 0) {
        $errors = $api->errors;
        return false;
      }

      $source['profile_id'] = $api->customer_profile_id;
      if (!$record->save($source,'',array('id','user_id'))) {
        $errors[] = $record->getError();
        return false;
      }
    } else {
      $source['profile_id'] = $record->profile_id;
      $api->customer_profile_id = $record->profile_id;
    }

    if (empty($record->payment_id)) {
      $api->create_payment_profile();
      if (count($api->errors) > 0) {
        $errors = $api->errors;
        return false;
      }
      $source['payment_id'] = $api->customer_payment_id;
      if (!$record->save($source,'',array('id','user_id'))) {
        $errors[] = $record->getError();
        return false;
      }
    } else {
      $source['payment_id'] = $record->payment_id;
      $api->customer_payment_id = $record->payment_id;
    }

    if (empty($record->shipping_id)) {
      $api->create_shipping_address();
      if (count($api->errors) > 0) {
        $errors = $api->errors;
        return false;
      }
      $source['shipping_id'] = $api->customer_address_id;
      if (!$record->save($source,'',array('id','user_id'))) {
        $errors[] = $record->getError();
        return false;
      }
    } else { // Not necessary :p
      $source['shipping_id'] = $record->shipping_id; 
      $api->customer_address_id = $record->shipping_id;
    }

    return true;
  }

  /**
   * Loads this customer model using a record identifier.
   */
  public function load($id)
  {
    $record =& $this->getTable();
    if ($record->load((int)$id)) {
      $this->id = $record->id;
      $this->userId = $record->user_id;
      $this->profileId = $record->profile_id;
      $this->paymentId = $record->payment_id;
      $this->shippingId = $record->shipping_id;
    }
  }

  /**
   * Loads this customer model using an user identifier.
   */
  public function loadByUserId($uid)
  {
    $record =& $this->getTable();
    if ($record->load_by_user_id((int)$uid)) {
      $this->id = $record->id;
      $this->userId = $record->user_id;
      $this->profileId = $record->profile_id;
      $this->paymentId = $record->payment_id;
      $this->shippingId = $record->shipping_id;
    }
  }
 
  public function getId() {
    return $this->id;
  }
  public function setId($value) {
    $this->id = $value;
  }

  /**
   * Get the user id
   * @return string The user id.
   */
  public function getUserId() 
  {
    if (!$this->hasUserId()) 
    {
      $this->userId = 0;
    }

    return $this->userId;
  }
  public function hasUserId() 
  {
    return (isset($this->userId) && $this->userId > 0);
  }

  /**
   * Get the CIM profile id
   * @return string The CIM profile id.
   */
  public function getProfileId() 
  {
    if (!$this->hasProfileId()) 
    {
      $this->profileId = '';
    }

    return $this->profileId;
  }
  public function hasProfileId() 
  {
    return !empty($this->profileId);
  }
 
  /**
   * Get the CIM payment id
   * @return string The CIM payment id.
   */
  public function getPaymentId() 
  {
    if (!$this->hasPaymentId()) 
    {
      $this->paymentId = '';
    }

    return $this->paymentId;
  }
  public function hasPaymentId() 
  {
    return !empty($this->paymentId);
  }

  /**
   * Get the CIM shipping id
   * @return string The CIM shipping id.
   */
  public function getShippingId() 
  {
    if (!$this->hasShippingId())
    {
      $this->shippingId = '';
    }

    return $this->shippingId;
  }
  public function hasShippingId() 
  {
    return !empty($this->shippingId);
  }

}