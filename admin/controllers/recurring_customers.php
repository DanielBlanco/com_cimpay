<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * Recurring Controller
 */
class CimpayControllerRecurring_customers extends JController
{

  function action_index() {
    $rc = $this->getModel('Recurring_customer');
    $model = $this->getModel('Recurring_customers');
    $view =& $this->getView( 'recurring_customers', 'html' ); 
    $view->setModel( $model, true );
    $view->display();
  }

  function action_close() {
    $this->setRedirect( JRoute::_('index.php?option=com_cimpay&task=recurring.dashboard', false) );
  }

  function action_cancel() {
    $this->setRedirect( JRoute::_('index.php?option=com_cimpay&task=recurring_customers.action_index', false) );
  }

  function action_new() {
    $view =& $this->getView( 'recurring_customers', 'html' ); 
    $view->setModel( $this->getModel( 'Recurring_customer' ), true );
    $view->setModel( $this->getModel( 'Recurring_packages' ) );
    $view->setModel( $this->getModel( 'Customers' ) );
    $view->displayNew();
  }

  function action_save() {
    $today = (String)date('Y-m-d');
    $model = $this->getModel( 'Recurring_customer' );

    $id = (int)JRequest::getVar('id','0','post','INTEGER');
    if ($id > 0) {
      $model->load($id);
    }
    $model->setCustomerId((int)JRequest::getVar('customer_id', 0,'post','INTEGER'));
    $model->setPackageId((int)JRequest::getVar('package_id', 0,'post','INTEGER'));
    $model->setCreatedAt();
    $model->setUpdatedAt();

    if ($model->save()) {
      $this->setRedirect( JRoute::_('index.php?option=com_cimpay&task=recurring_customers.action_index', false) );
    } else {
      $view =& $this->getView( 'recurring_customers', 'html' ); 
      $view->setModel( $model, true );
      $view->displayNew();
    }
  }

  function action_edit() {
    $id = JRequest::getVar('id',0);
    $model = $this->getModel( 'Recurring_customer' );
    $model->load($id);
    $view =& $this->getView( 'recurring_customers', 'html' ); 
    $view->setModel( $model, true );
    $view->setModel( $this->getModel( 'Recurring_packages' ) );
    $view->setModel( $this->getModel( 'Customers' ) );
    $view->displayEdit();
  }

  function action_destroy() {
    $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
    $model = $this->getModel( 'Recurring_customer' );
    $msg = null;
    if (!$model->destroy($cids)) {
      $msg = JText::_( 'Could not delete the customer payment plan.' );
    }
    $this->setRedirect( JRoute::_('index.php?option=com_cimpay&task=recurring_customers.action_index', false) );
  }

}