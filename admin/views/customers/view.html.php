<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * Profiles View
 */
class CimpayViewCustomers extends JView
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

    // Retrieve the data.
    $this->items = $this->get('Items');
    $this->pagination = $this->get('Pagination');
    
    // Set the toolbar
    $this->addToolBar();

    // Set the document
    $this->setDocument();

    // Display the template
    parent::display($tpl);
  }

 
  /**
   * Setting the toolbar
   */
  protected function addToolBar() 
  {
    // The second parameter will be used to construct the css class for the title.
    JToolBarHelper::title(JText::_('COM_CIMPAY_MANAGER_CONFIG'), 'cimpay');
    JToolBarHelper::custom( 'recurring.index', 'recurring.png', 'recurring.png', 'Recurring Billing', false, false );
    JToolBarHelper::custom( 'transactions.report', 'exec.png', 'exec.png', 'Transactions', false, false );
    JToolBarHelper::preferences('com_cimpay');
  }

  /**
   * Method to set up the document properties
   *
   * @return void
   */
  protected function setDocument() 
  {
    // Sets the browser title.
    $document = JFactory::getDocument();
    $document->setTitle(JText::_('COM_CIMPAY_ADMINISTRATION'));
  }
}