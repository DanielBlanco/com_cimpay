<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('joomla.log.log');
jimport('joomla.application.component.controller');

// Add the logger.
JLog::addLogger(array('text_file' => 'com_cimpay.log.php'));

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
  // log the entry
  JLog::add($message);
  // for good luck, make sure we do actually stop now!
  jexit($message);
}