<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * Recurring Controller
 */
class CimpayControllerRecurring_services extends JController
{

  function action_index() {
    $model = $this->getModel('Recurring_services');
    $view =& $this->getView( 'recurring_services', 'html' ); 
    $view->setModel( $model, true );
    $view->display();
  }

  function action_close() {
    $this->setRedirect( JRoute::_('index.php?option=com_cimpay&task=recurring.dashboard', false) );
  }

  function action_cancel() {
    $this->setRedirect( JRoute::_('index.php?option=com_cimpay&task=recurring_services.action_index', false) );
  }

  function action_new() {
    $model = $this->getModel( 'Recurring_service' );
    $view =& $this->getView( 'recurring_services', 'html' ); 
    $view->setModel( $model, true );
    $view->displayNew();
  }

  function action_save() {
    $today = (String)date('Y-m-d');
    $model = $this->getModel( 'Recurring_service' );
    $cost_per_month = (float)JRequest::getVar('cost_per_month', 1.0);
    $months_to_bill = (int)JRequest::getVar('months_to_bill', 1);
    $total_cost = $cost_per_month * $months_to_bill;
    $id = (int)JRequest::getVar('id','0','post','INTEGER');
    if ($id > 0) {
      $model->load($id);
    }

    $model->setName(JRequest::getVar('name'));
    $model->setDescription(JRequest::getVar('description'));
    $model->setActive(JRequest::getVar('active', 1));
    $model->setStartAt(JRequest::getVar('start_at', $today));//2012-01-01
    $model->setMonthsToBill($months_to_bill);
    $model->setTotalCost($total_cost);
    $model->setCreatedAt();
    $model->setUpdatedAt();

    if ($model->save()) {
      $this->setRedirect( JRoute::_('index.php?option=com_cimpay&task=recurring_services.action_index', false) );
    } else {
      $view =& $this->getView( 'recurring_services', 'html' ); 
      $view->setModel( $model, true );
      $view->displayNew();
    }
  }

  function action_edit() {
    $id = JRequest::getVar('id',0);
    $model = $this->getModel( 'Recurring_service' );
    $model->load($id);
    $view =& $this->getView( 'recurring_services', 'html' ); 
    $view->setModel( $model, true );
    $view->displayEdit();
  }

  function action_destroy() {
    $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
    $model = $this->getModel( 'Recurring_service' );
    $msg = null;
    if (!$model->destroy($cids)) {
      $msg = JText::_( 'Could not delete the services.' );
    }
    $this->setRedirect( JRoute::_('index.php?option=com_cimpay&task=recurring_services.action_index', false) );
  }

}