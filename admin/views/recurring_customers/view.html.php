<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * Recurring View
 */
class CimpayViewRecurring_customers extends JView
{
  /**
   * Config view display method
   * @return void
   */
  function display($tpl = null) 
  {
    // Check for errors.
    if (count($errors = $this->get('Errors'))) {
      JError::raiseError(500, implode('<br />', $errors));
      return false;
    }
    
    // Set the toolbar
    JRequest::setVar('hidemainmenu', true);
    JToolBarHelper::title(JText::_('COM_CIMPAY_RECURRING_CUSTOMERS_INDEX'), 'cimpay');
    JToolBarHelper::addnew('recurring_customers.action_new', 'JTOOLBAR_NEW');
    JToolBarHelper::deleteList('Delete selected customer plans?','recurring_customers.action_destroy', 'JTOOLBAR_DELETE');
    JToolBarHelper::cancel('recurring_customers.action_close', 'JTOOLBAR_CLOSE');
    JToolBarHelper::preferences('com_cimpay');

    $this->items = $this->get('Items');
    $this->pagination = $this->get('Pagination');

    parent::display($tpl); // Display the template
    $document = JFactory::getDocument(); // Set the document
    $document->setTitle(JText::_('COM_CIMPAY_RECURRING_CUSTOMERS_INDEX')); // Sets the browser title.
  }

  function displayNew($tpl = null) {
    // Check for errors.
    if (count($errors = $this->get('Errors'))) {
      JError::raiseError(500, implode('<br />', $errors));
      return false;
    }
    $this->setLayout('form');
    $this->customers = $this->get( 'Items', 'Customers' );
    $this->packages = $this->get( 'Items', 'Recurring_packages' );

    // Set the toolbar
    JRequest::setVar('hidemainmenu', true);
    JToolBarHelper::title(JText::_('COM_CIMPAY_RECURRING_CUSTOMERS_NEW'), 'cimpay');
    JToolBarHelper::save('recurring_customers.action_save', 'JTOOLBAR_SAVE');
    JToolBarHelper::cancel('recurring_customers.action_cancel', 'JTOOLBAR_CLOSE');
    JToolBarHelper::preferences('com_cimpay');

    parent::display($tpl); // Display the template
    $document = JFactory::getDocument(); // Set the document
    $document->setTitle(JText::_('COM_CIMPAY_RECURRING_CUSTOMERS_NEW')); // Sets the browser title.
  }

  function displayEdit($tpl = null) {
    // Check for errors.
    if (count($errors = $this->get('Errors'))) {
      JError::raiseError(500, implode('<br />', $errors));
      return false;
    }
    $this->setLayout('form');
    $this->customers = $this->get( 'Items', 'Customers' );
    $this->packages = $this->get( 'Items', 'Recurring_packages' );

    // Set the toolbar
    JRequest::setVar('hidemainmenu', true);
    JToolBarHelper::title(JText::_('COM_CIMPAY_RECURRING_CUSTOMERS_EDIT'), 'cimpay');
    JToolBarHelper::save('recurring_customers.action_save', 'JTOOLBAR_SAVE');
    JToolBarHelper::cancel('recurring_customers.action_cancel', 'JTOOLBAR_CLOSE');
    JToolBarHelper::preferences('com_cimpay');

    parent::display($tpl); // Display the template
    $document = JFactory::getDocument(); // Set the document
    $document->setTitle(JText::_('COM_CIMPAY_RECURRING_CUSTOMERS_EDIT')); // Sets the browser title.
  }


}