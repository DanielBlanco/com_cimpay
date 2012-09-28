<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the Cimpay Component
 */
class CimpayViewShow extends JView
{

  // Overwriting JView display method
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
    $this->packages = $this->get('Items', 'Recurring_packages');
    //$this->pagination = $this->get('Pagination');

    parent::display($tpl);
  }

}