<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the Cimpay Component
 */
class CimpayViewCreate extends JView
{

  // Overwriting JView display method
  function display($tpl = null) 
  {
    // Assign data to the view
    //$this->msg = $this->get('Greeting');
    //$userId = & $this->get( 'UserId', 'customer' );
 
    // Check for errors.
    if (count($errors = $this->get('Errors'))) 
    {
      JError::raiseError(500, implode('<br />', $errors));
      return false;
    }
    
    parent::display($tpl);
  }

}