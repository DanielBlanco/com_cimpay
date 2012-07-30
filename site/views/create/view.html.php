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
    $user=& JFactory::getUser();
    $this->email = $user->email;

    // Split full name into first and last.
    $pos = strrpos($user->name, ' ');
    if ($pos === false) {
      $this->first_name = trim($user->name);
      $this->last_name = '';
    } else {
      $this->first_name = trim(substr($user->name, 0, $pos + 1));
      $this->last_name = trim(substr($user->name, $pos));
    }
 
    // Check for errors.
    if (count($errors = $this->get('Errors'))) 
    {
      JError::raiseError(500, implode('<br />', $errors));
      return false;
    }
    
    parent::display($tpl);
  }

}