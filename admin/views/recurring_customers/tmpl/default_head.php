<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<tr>
  <th style="white-space: nowrap" width="1%">
    <input type="checkbox" name="toggle" value="0" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
  </th>
  <th style="white-space: nowrap" width="4%">
    <?php echo JText::_('COM_CIMPAY_RECURRING_CUSTOMERS_HEADING_ID'); ?>
  </th>
  <th style="white-space: nowrap" width="15%">
    <?php echo JText::_('COM_CIMPAY_RECURRING_CUSTOMERS_HEADING_CUSTOMER_NAME'); ?>
  </th>
  <th style="white-space: nowrap" width="15%">
    <?php echo JText::_('COM_CIMPAY_RECURRING_CUSTOMERS_HEADING_CUSTOMER_EMAIL'); ?>
  </th>
  <th style="white-space: nowrap" width="20%">
    <?php echo JText::_('COM_CIMPAY_RECURRING_CUSTOMERS_HEADING_SERVICE_NAME'); ?>
  </th>
  <th style="white-space: nowrap" width="20%">
    <?php echo JText::_('COM_CIMPAY_RECURRING_CUSTOMERS_HEADING_PACKAGE_NAME'); ?>
  </th>
</tr>