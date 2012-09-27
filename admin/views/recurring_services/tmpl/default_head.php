<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<tr>
  <th style="white-space: nowrap" width="1%">
    <input type="checkbox" name="toggle" value="0" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
  </th>
  <th style="white-space: nowrap" width="4%">
    <?php echo JText::_('COM_CIMPAY_RECURRING_SERVICES_HEADING_ID'); ?>
  </th>
  <th style="white-space: nowrap" width="10%">
    <?php echo JText::_('COM_CIMPAY_RECURRING_SERVICES_HEADING_NAME'); ?>
  </th>
  <th width="50%">
    <?php echo JText::_('COM_CIMPAY_RECURRING_SERVICES_HEADING_DESCRIPTION'); ?>
  </th>
  <th style="white-space: nowrap" width="5%">
    <?php echo JText::_('COM_CIMPAY_RECURRING_SERVICES_HEADING_ACTIVE'); ?>
  </th>
  <th style="white-space: nowrap" width="10%">
    <?php echo JText::_('COM_CIMPAY_RECURRING_SERVICES_HEADING_START_AT'); ?>
  </th>
  <th style="white-space: nowrap" width="5%">
    <?php echo JText::_('COM_CIMPAY_RECURRING_SERVICES_HEADING_MONTHS_TO_BILL'); ?>
  </th>
  <th style="white-space: nowrap" width="5%">
    <?php echo JText::_('COM_CIMPAY_RECURRING_SERVICES_HEADING_TOTAL_COST'); ?>
  </th>
  <th style="white-space: nowrap" width="10%">
    <?php echo JText::_('COM_CIMPAY_RECURRING_SERVICES_HEADING_ACTIONS'); ?>
  </th>
</tr>