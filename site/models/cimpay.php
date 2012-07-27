<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.model');
 
/**
 * Cimpay Model
 */
class CimpayModelCimpay extends JModel
{

  /**
   * @var string greeting
   */
  protected $greeting;
  protected $params;
 
  /**
   * Returns a reference to the a Table object, always creating it.
   *
   * @param type  The table type to instantiate
   * @param string  A prefix for the table class name. Optional.
   * @param array Configuration array for model. Optional.
   * @return  JTable  A database object
   * @since 2.5
   */
  public function getTable($type = 'Cimpay', $prefix = 'CimpayTable', $config = array()) 
  {
    return JTable::getInstance($type, $prefix, $config);
  }
 
  /**
   * Get the greeting message
   * @return string The greeting message to be displayed to the user
   */
  public function getGreeting() 
  {
    if (!isset($this->greeting)) 
    {
      //request the selected id
      $id = $this->getRequestId();

      $table = $this->getTable();
      $table->load($id);

      $this->greeting = $table->greeting;
    }
    return $this->greeting;
  }

  /**
   * Get the configuration parameters
   * @return string The component settings.
   */
  public function getParams()
  {
    if (!isset($this->params))
    {
      //request the selected id
      $id = $this->getRequestId();

      $table = $this->getTable();
      $table->load($id);

      $this->params = $table->params;
    }
    return $this->params;
  }
 
  /**
   * Requested record ID.
   * @return int id requested.
   */
  public function getRequestId()
  {
    //request the selected id
    $input = JFactory::getApplication()->input;
    return $input->getInt('id', 1);
  }

}