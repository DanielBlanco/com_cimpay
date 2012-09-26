<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * Recurring View
 */
class CimpayViewRecurring extends JView
{
  /**
   * Config view display method
   * @return void
   */
  function display($tpl = null) 
  {
    // Check for errors.
    if (count($errors = $this->get('Errors'))) 
    {
      JError::raiseError(500, implode('<br />', $errors));
      return false;
    }
    
    // Set the toolbar
    JRequest::setVar('hidemainmenu', true);
    JToolBarHelper::title(JText::_('COM_CIMPAY_RECURRING_INDEX'), 'cimpay');
    JToolBarHelper::cancel('recurring.cancel', 'JTOOLBAR_CLOSE');
    JToolBarHelper::preferences('com_cimpay');

    // Display the template
    parent::display($tpl);

    // Set the document
    // Sets the browser title.
    $document = JFactory::getDocument();
    $document->setTitle(JText::_('COM_CIMPAY_RECURRING_INDEX'));
  }

  /**
   * Config view display method
   * @return void
   */
  function displayDashboard($tpl = null)
  {
    $this->setLayout('dashboard');

    // Check for errors.
    if (count($errors = $this->get('Errors'))) 
    {
      JError::raiseError(500, implode('<br />', $errors));
      return false;
    }

    // Retrieve the data.
    //$this->items = $this->get('Items');
    //$this->pagination = $this->get('Pagination');
    
    // Set the toolbar
    JRequest::setVar('hidemainmenu', true);
    JToolBarHelper::title(JText::_('COM_CIMPAY_RECURRING_DASHBOARD'), 'cimpay');
    JToolBarHelper::cancel('recurring.cancel', 'JTOOLBAR_CLOSE');
    JToolBarHelper::preferences('com_cimpay');

    // Display the template
    parent::display($tpl);

    $document = JFactory::getDocument();
    $document->setTitle(JText::_('COM_CIMPAY_RECURRING_DASHBOARD'));
  }

}