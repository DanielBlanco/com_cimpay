<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the Cimpay Component
 */
class CimpayViewCimpay extends JView
{
  // Overwriting JView display method
  function display($tpl = null) 
  {
    // Assign data to the view
    $this->msg = $this->get('Greeting');
 
    // Check for errors.
    if (count($errors = $this->get('Errors'))) 
    {
      JError::raiseError(500, implode('<br />', $errors));
      return false;
    }
    
    $user=& JFactory::getUser();
    if ($user->guest || $user->id == 0)
      parent::display('');
    } else {
      parent::display($tpl);
    }
  }

  function isLogged()
  {
    
    if (!$user->guest)
    {
      $userId = (int) $user->get('id');
    }
  }


}