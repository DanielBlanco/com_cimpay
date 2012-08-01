<?php

/**
 * @version   $Id: helloworld.php 59 2010-11-27 14:17:52Z chdemko $
 * @package   Joomla16.Tutorials
 * @subpackage  Components
 * @copyright Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @author    Christophe Demko
 * @link    http://joomlacode.org/gf/project/helloworld_1_6/
 * @license   License GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * Transaction Controller
 */
class CimpayControllerTransactions extends JController
{

  /*
   * Build Transaction.
   */
  function build()
  {
    $pk = JRequest::getInt('id');
    $model = $this->getModel('Customer');
    $model->setState('CimpayModelCustomer.id', $pk);

    $view =& $this->getView( 'transactions', 'html' ); 
    $view->setLayout('build');
    $view->setModel( $model, true );
    $view->display();
  }

  /**
   * Cancel the transaction.
   */
  function cancel() {
    $this->setRedirect( JRoute::_('index.php?option=com_cimpay') );
  }

  /**
   * Save the transaction.
   */
  function save() {
    $t = $this->getModel('Transaction');
    $t->setCustomerId(JRequest::getInt('id'));
    $t->setAmount(JRequest::getVar('amount'));
    $t->setShippingAmount(JRequest::getVar('shipping_amount'));
    $t->setShippingName(JRequest::getVar('shipping_name'));
    $t->setShippingDescription(JRequest::getVar('shipping_description'));
    $t->setItemId(JRequest::getVar('item_id'));
    $t->setItemName(JRequest::getVar('item_name'));
    $t->setItemDescription(JRequest::getVar('item_description'));
    $t->setItemQuantity(JRequest::getVar('item_quantity'));
    $t->setItemUnitPrice(JRequest::getVar('item_unit_price'));
    $t->setOrderInvoiceNumber(JRequest::getVar('order_invoice_number'));
    $t->setBillingDate(JRequest::getVar('billing_date'));
    if ($t->save()) {
      $msg = JText::_( 'Transaction Created!' );
      $this->setRedirect( JRoute::_('index.php?option=com_cimpay'), $msg );
    } else {
      $model = $this->getModel('Customer');
      $model->setState('CimpayModelCustomer.id', $t->getCustomerId());

      $view =& $this->getView( 'transactions', 'html' ); 
      $view->setLayout('build');
      $view->setModel( $model, true );
      $view->display();
    }
  }

  /**
   * Transaction Report.
   */
  function report() {
    $model = $this->getModel('Transactions');
    $view =& $this->getView( 'transactions', 'html' ); 
    $view->setModel( $model, true );
    $view->displayIndex();
  }

  /**
   * Collect Dues.
   */
  function collect() {
    $msg = JText::_( 'Dues Collected' );   
    $model = $this->getModel('Transactions');
    $model->collectDues();
    $this->setRedirect( JRoute::_('index.php?option=com_cimpay\&task=transactions.report', false), $msg );
  }
}