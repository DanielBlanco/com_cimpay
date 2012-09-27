<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * Recurring View
 */
class CimpayViewRecurring_services extends JView
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
    JToolBarHelper::title(JText::_('COM_CIMPAY_RECURRING_SERVICES_INDEX'), 'cimpay');
    JToolBarHelper::addnew('recurring_services.action_new', 'JTOOLBAR_NEW');
    JToolBarHelper::deleteList('Delete selected services?','recurring_services.action_destroy', 'JTOOLBAR_DELETE');
    JToolBarHelper::cancel('recurring_services.action_close', 'JTOOLBAR_CLOSE');
    JToolBarHelper::preferences('com_cimpay');

    $this->items = $this->get('Items');
    $this->pagination = $this->get('Pagination');

    parent::display($tpl); // Display the template
    $document = JFactory::getDocument(); // Set the document
    $document->setTitle(JText::_('COM_CIMPAY_RECURRING_SERVICES_INDEX')); // Sets the browser title.
  }

  function displayNew($tpl = null) {
    // Check for errors.
    if (count($errors = $this->get('Errors'))) {
      JError::raiseError(500, implode('<br />', $errors));
      return false;
    }
    $this->setLayout('form');
    $this->costPerMonth = 0.00;

    // Set the toolbar
    JRequest::setVar('hidemainmenu', true);
    JToolBarHelper::title(JText::_('COM_CIMPAY_RECURRING_SERVICES_NEW'), 'cimpay');
    JToolBarHelper::save('recurring_services.action_save', 'JTOOLBAR_SAVE');
    JToolBarHelper::cancel('recurring_services.action_cancel', 'JTOOLBAR_CLOSE');
    JToolBarHelper::preferences('com_cimpay');

    parent::display($tpl); // Display the template
    $document = JFactory::getDocument(); // Set the document
    $document->setTitle(JText::_('COM_CIMPAY_RECURRING_SERVICES_NEW')); // Sets the browser title.
  }

  function displayEdit($tpl = null) {
    // Check for errors.
    if (count($errors = $this->get('Errors'))) {
      JError::raiseError(500, implode('<br />', $errors));
      return false;
    }
    $this->setLayout('form');
    $model =& $this->getModel();
    $tc = $model->get('total_cost');
    $mtb = $model->get('months_to_bill');
    $this->costPerMonth = 0.00;
    if ($tc > 0.0) {
      $this->costPerMonth = ($tc / $mtb);
    }

    // Set the toolbar
    JRequest::setVar('hidemainmenu', true);
    JToolBarHelper::title(JText::_('COM_CIMPAY_RECURRING_SERVICES_EDIT'), 'cimpay');
    JToolBarHelper::save('recurring_services.action_save', 'JTOOLBAR_SAVE');
    JToolBarHelper::cancel('recurring_services.action_cancel', 'JTOOLBAR_CLOSE');
    JToolBarHelper::preferences('com_cimpay');

    parent::display($tpl); // Display the template
    $document = JFactory::getDocument(); // Set the document
    $document->setTitle(JText::_('COM_CIMPAY_RECURRING_SERVICES_EDIT')); // Sets the browser title.
  }


}