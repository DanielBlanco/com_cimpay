<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * Recurring Controller
 */
class CimpayControllerRecurring_packages extends JController
{

  function action_index() {
    $model = $this->getModel('Recurring_packages');
    $view =& $this->getView( 'recurring_packages', 'html' ); 
    $view->setModel( $model, true );
    $view->display();
  }

  function action_close() {
    $this->setRedirect( JRoute::_('index.php?option=com_cimpay&task=recurring.dashboard', false) );
  }

  function action_cancel() {
    $this->setRedirect( JRoute::_('index.php?option=com_cimpay&task=recurring_packages.action_index', false) );
  }

  function action_new() {
    $view =& $this->getView( 'recurring_packages', 'html' ); 
    $view->setModel( $this->getModel( 'Recurring_package' ), true );
    $view->setModel( $this->getModel( 'Recurring_services' ) );
    $view->displayNew();
  }

  function action_save() {
    $today = (String)date('Y-m-d');
    $model = $this->getModel( 'Recurring_package' );

    $id = (int)JRequest::getVar('id','0','post','INTEGER');
    if ($id > 0) {
      $model->load($id);
    }
    $model->setServiceId((int)JRequest::getVar('service_id', 0,'post','INTEGER'));
    $model->setName(JRequest::getVar('name'));
    $model->setDescription(JRequest::getVar('description'));
    $model->setMonthsToPay(JRequest::getVar('months_to_pay', 1));
    $model->setRecurring(JRequest::getVar('recurring', 0));
    $model->setActive(JRequest::getVar('active', 1));
    $model->setDiscount(JRequest::getVar('discount', 0));
    $model->setCreatedAt();
    $model->setUpdatedAt();

    if ($model->save()) {
      $this->setRedirect( JRoute::_('index.php?option=com_cimpay&task=recurring_packages.action_index', false) );
    } else {
      $view =& $this->getView( 'recurring_packages', 'html' ); 
      $view->setModel( $model, true );
      $view->displayNew();
    }
  }

  function action_edit() {
    $id = JRequest::getVar('id',0);
    $model = $this->getModel( 'Recurring_package' );
    $model->load($id);
    $view =& $this->getView( 'recurring_packages', 'html' ); 
    $view->setModel( $model, true );
    $view->setModel( $this->getModel( 'Recurring_services' ) );
    $view->displayEdit();
  }

  function action_destroy() {
    $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
    $model = $this->getModel( 'Recurring_package' );
    $msg = null;
    if (!$model->destroy($cids)) {
      $msg = JText::_( 'Could not delete the packages.' );
    }
    $this->setRedirect( JRoute::_('index.php?option=com_cimpay&task=recurring_packages.action_index', false) );
  }

}