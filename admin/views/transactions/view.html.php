<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * Transactions View
 */
class CimpayViewTransactions extends JView
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

    $this->item = $this->get('Item');
    
    // Set the toolbar
    JRequest::setVar('hidemainmenu', true);
    JToolBarHelper::title(JText::_('COM_CIMPAY_NEW_TRANSACTION'), 'cimpay');
    JToolBarHelper::save('transactions.save', 'JTOOLBAR_SAVE');
    JToolBarHelper::cancel('transactions.cancel', 'JTOOLBAR_CLOSE');
    JToolBarHelper::preferences('com_cimpay');

    // Display the template
    parent::display($tpl);

    // Set the document
    // Sets the browser title.
    $document = JFactory::getDocument();
    $document->setTitle(JText::_('COM_CIMPAY_NEW_TRANSACTION'));
  }

  /**
   * Config view display method
   * @return void
   */
  function displayIndex($tpl = null)
  {
    $this->setLayout('index');

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
    JToolBarHelper::title(JText::_('COM_CIMPAY_COLLECTING_DUES_REPORT'), 'cimpay');
    JToolBarHelper::cancel( 'transactions.cancel', 'JTOOLBAR_CLOSE' );
    JToolBarHelper::custom( 'transactions.collect', 'exec.png', 'exec.png', 'Collect Dues', false, false );
    JToolBarHelper::preferences('com_cimpay');

    // Display the template
    parent::display($tpl);

    $document = JFactory::getDocument();
    $document->setTitle(JText::_('COM_CIMPAY_COLLECTING_DUES'));
  }

}