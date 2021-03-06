<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controller library
jimport('joomla.application.component.controller');
 
/**
 * Cimpay Component Controller
 */
class CimpayController extends JController
{

  /**
   * Method to display the view
   *
   * @access    public
   */
  function display($cachable = false)
  {
    $view = null;
    $user=& JFactory::getUser();
    $customer = $this->getModel( 'Customer' );
    $customer->loadByUserId($user->id);

    if ($user->guest || $user->id == 0) {
      $view = $this->viewGuest();
    } elseif ( $customer->hasProfileId() ) {
      $view = $this->showProfile();
    } else {
      $view = $this->createProfile();
    }

    $view->display();
  }

  /**
   * Task Create.
   */
  function create()
  {
    $user=& JFactory::getUser();
    $input = JFactory::getApplication()->input;
    $customer = $this->getModel( 'Customer' );
    
    $arguments = array(
      'user_id' => $user->id,
      'email' => $user->email,
      'first_name' => $input->get('first_name'),
      'last_name' => $input->get('last_name'),
      'address' => $input->get('address'),
      'city' => $input->get('city'),
      'state' => $input->get('state'),
      'zip' => $input->get('zip'),
      'country' => 'US',
      'phone_number' => $input->get('phone_number'),
      'cc_card_number' => $input->get('cc_card_number'),
      'cc_expiration_date' => $input->get('cc_expiration_date')
    );

    $errors = array();
    $success = $customer->createCustomerProfile($arguments, $errors);
    if ($success) {
      $view = $this->showProfile();
    } else {
      $view = $this->createProfile();
      $view->errors = $errors;
    }
    $view->display();
  }

  function viewGuest()
  {
    $view =& $this->getView( 'guest', 'html' ); 
    return $view;
  }

  function showProfile()
  {
    $view =& $this->getView( 'show', 'html' ); 
    $view->setModel($this->getModel('Transactions'), true);
    $view->setModel($this->getModel('Recurring_packages'));
    return $view;
  }

  function createProfile()
  {
    $view =& $this->getView( 'create', 'html' ); 
    $view->errors = array();
    //$view->setModel($this->getModel( 'Customer' ));
    return $view;
  }

  function buy_service() {
    $user=& JFactory::getUser();
    $customer = $this->getModel( 'Customer' );
    $customer->loadByUserId($user->id);

    if ($customer->getId()) {
      $package_id = (int)JRequest::getVar('cimpay_service', 0,'post','INTEGER');

      $model = $this->getModel( 'Recurring_customer' );
      $model->setCustomerId($customer->getId());
      $model->setPackageId($package_id);
      $model->setCreatedAt();
      $model->setUpdatedAt();

      if ($model->save(true)) {
        $this->setRedirect( JRoute::_('index.php?option=com_cimpay&task=show', false) );
      } else {
        $this->setRedirect( JRoute::_('index.php?option=com_cimpay&task=show', false), "Couldn't process the transaction." );
      }
    } else {
      $this->setRedirect( JRoute::_('index.php?option=com_cimpay&task=show', false), "Couldn't process the transaction." );
    }
  }

}