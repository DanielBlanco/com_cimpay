<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * Recurring View
 */
class CimpayViewRecurring_packages extends JView
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
    JToolBarHelper::title(JText::_('COM_CIMPAY_RECURRING_PACKAGES_INDEX'), 'cimpay');
    JToolBarHelper::addnew('recurring_packages.action_new', 'JTOOLBAR_NEW');
    JToolBarHelper::deleteList('Delete selected packages?','recurring_packages.action_destroy', 'JTOOLBAR_DELETE');
    JToolBarHelper::cancel('recurring_packages.action_close', 'JTOOLBAR_CLOSE');
    JToolBarHelper::preferences('com_cimpay');

    $this->items = $this->get('Items');
    $this->pagination = $this->get('Pagination');

    parent::display($tpl); // Display the template
    $document = JFactory::getDocument(); // Set the document
    $document->setTitle(JText::_('COM_CIMPAY_RECURRING_PACKAGES_INDEX')); // Sets the browser title.
  }

  function displayNew($tpl = null) {
    // Check for errors.
    if (count($errors = $this->get('Errors'))) {
      JError::raiseError(500, implode('<br />', $errors));
      return false;
    }
    $this->setLayout('form');
    $this->services = $this->get( 'Items', 'Recurring_services' );

    // Set the toolbar
    JRequest::setVar('hidemainmenu', true);
    JToolBarHelper::title(JText::_('COM_CIMPAY_RECURRING_PACKAGES_NEW'), 'cimpay');
    JToolBarHelper::save('recurring_packages.action_save', 'JTOOLBAR_SAVE');
    JToolBarHelper::cancel('recurring_packages.action_cancel', 'JTOOLBAR_CLOSE');
    JToolBarHelper::preferences('com_cimpay');

    parent::display($tpl); // Display the template
    $document = JFactory::getDocument(); // Set the document
    $document->setTitle(JText::_('COM_CIMPAY_RECURRING_PACKAGES_NEW')); // Sets the browser title.
  }

  function displayEdit($tpl = null) {
    // Check for errors.
    if (count($errors = $this->get('Errors'))) {
      JError::raiseError(500, implode('<br />', $errors));
      return false;
    }
    $this->setLayout('form');
    $this->services = $this->get( 'Items', 'Recurring_services' );

    // Set the toolbar
    JRequest::setVar('hidemainmenu', true);
    JToolBarHelper::title(JText::_('COM_CIMPAY_RECURRING_PACKAGES_EDIT'), 'cimpay');
    JToolBarHelper::save('recurring_packages.action_save', 'JTOOLBAR_SAVE');
    JToolBarHelper::cancel('recurring_packages.action_cancel', 'JTOOLBAR_CLOSE');
    JToolBarHelper::preferences('com_cimpay');

    parent::display($tpl); // Display the template
    $document = JFactory::getDocument(); // Set the document
    $document->setTitle(JText::_('COM_CIMPAY_RECURRING_PACKAGES_EDIT')); // Sets the browser title.
  }


}