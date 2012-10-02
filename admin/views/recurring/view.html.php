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
    
    $this->items = $this->get('Items');
    $this->pagination = $this->get('Pagination');

    // Set the toolbar
    JRequest::setVar('hidemainmenu', false);
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
    $this->items = $this->get('Items');
    $this->pagination = $this->get('Pagination');
    
    // Set the toolbar
    JRequest::setVar('hidemainmenu', true);
    JToolBarHelper::title(JText::_('COM_CIMPAY_RECURRING_DASHBOARD'), 'cimpay');
    JToolBarHelper::custom( 'recurring_services.action_index', 'services.png', 'services.png', 'Services', false, false );
    JToolBarHelper::custom( 'recurring_packages.action_index', 'packages.png', 'packages.png', 'Packages', false, false ); 
    JToolBarHelper::custom( 'recurring_customers.action_index', 'customers.png', 'customers.png', 'Customers', false, false ); 
    JToolBarHelper::cancel('recurring.cancel', 'JTOOLBAR_CLOSE');
    JToolBarHelper::preferences('com_cimpay');

    // Display the template
    parent::display($tpl);

    $document = JFactory::getDocument();
    $document->setTitle(JText::_('COM_CIMPAY_RECURRING_DASHBOARD'));
  }

  function getServiceStatus($service_id) {
    $model = $this->getModel();
    $status = $model->getServiceStatus($service_id);
    if ($status == 0) {
      return '<span style="font-weight: bold;color:green">OK</span>';
    } else {
      return '<span style="font-weight: bold;color:red">Overdue</span>';
    }
  }

  function getMonthsCollected($service_id) {
    $model = $this->getModel();
    return $model->getMonthsCollected($service_id);
  }

  function getMonthsWithTransaction($service_id) {
    $model = $this->getModel();
    return $model->getMonthsWithTransaction($service_id);
  }
  
}