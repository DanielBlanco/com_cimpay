<?php

/**
 * @version   $Id: packages.php 59 2010-11-27 14:17:52Z chdemko $
 * @author    Daniel Blanco
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

/**
 * Recurring Controller
 */
class CimpayControllerRecurring extends JController
{
  /**
   * Recurring index.
   */
  function index() {
    //$model = $this->getModel('Packages');
    $view =& $this->getView( 'recurring', 'html' ); 
    //$view->setModel( $model, true );
    $view->displayDashboard();
  }

  /**
   * Go back to home.
   */
  function cancel() {
    $this->setRedirect( JRoute::_('index.php?option=com_cimpay') );
  }

}