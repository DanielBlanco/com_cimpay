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

    if ($user->guest || $user->id == 0) {
      $view = $this->viewGuest();
    } elseif ( false ) {
      $view = $this->showProfile();
    } else {
      $view = $this->createProfile();
    }

    $view->display();
  }

  function create()
  {
    $customer = $this->getModel( 'Customer' );
    $mab = $customer->createCustomerProfile();
    // email
    // last_name
    // first_name
    // - company
    // address
    // city
    // state
    // zip
    // country
    // phoneNumber
    // - faxNumber
    // cardNumber
    // expirationDate

    // Create profile and show it
    $view = $this->showProfile();
    $view->mab = $mab;
    $view->display();
  }

  function viewGuest()
  {
    $view =& $this->getView( 'guest', 'html' ); 
    return $view;
  }

  function showProfile()
  {
    //
    $view =& $this->getView( 'show', 'html' ); 
    return $view;
  }

  function createProfile()
  {
    $view =& $this->getView( 'create', 'html' ); 
    $view->setModel($this->getModel( 'Customer' ));
    return $view;
  }

}