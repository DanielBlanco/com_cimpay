<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

require_once(dirname(__FILE__) . '/../lib/authnet_api.php'); 

/**
 * Customer Model
 */
class CimpayModelCustomer extends JModel
{

  /**
   * Returns a reference to the a Table object, always creating it.
   *
   * @param type  The table type to instantiate
   * @param string  A prefix for the table class name. Optional.
   * @param array Configuration array for model. Optional.
   * @return  JTable  A database object
   * @since 2.5
   */
  public function getTable($type = 'Customers', $prefix = 'CimpayTable', $config = array()) 
  {
    return JTable::getInstance($type, $prefix, $config);
  }

  /**
   * Method to get a single record.
   */
  public function getItem($pk = null)
  {
    // Initialise variables.
    $pk = (!empty($pk)) ? $pk : (int) $this->getState('CimpayModelCustomer.id');
    $table = $this->getTable();

    if ($pk > 0) {
      // Attempt to load the row.
      $return = $table->load($pk);

      // Check for a table object error.
      if ($return === false && $table->getError()) {
        $this->setError($table->getError());
        return false;
      }
    }

    // Convert to the JObject before adding other data.
    $properties = $table->getProperties(1);
    $item = JArrayHelper::toObject($properties, 'JObject');

    return $item;
  }

}