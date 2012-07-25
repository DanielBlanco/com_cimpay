<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('joomla.error.log');
$log = &JLog::getInstance('com_cimpay.log.php');
 
// import joomla controller library
jimport('joomla.application.component.controller');

try {
  // Get an instance of the controller prefixed by Cimpay
  $controller = JController::getInstance('Cimpay');
   
  // Perform the Request task
  $input = JFactory::getApplication()->input;
  $controller->execute($input->getCmd('task'));
  
  // Redirect if set by the controller
  $controller->redirect();
} catch (Exception $e) {
  // create a user friendly error message
  $message = 'An exception occurred: '.$e->getMessage();  
  // create entry array
  $entry = array('LEVEL' => '1', 'STATUS' => "500", 'COMMENT' => $e->getMessage());
  // log the entry
  $log->addEntry($entry);
  // Raise a 500.
  JError::raiseError(500, $message, $e);
  // for good luck, make sure we do actually stop now!
  jexit($message);
}