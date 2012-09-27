<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
 
// load tooltip behavior
JHtml::_('behavior.tooltip');
?>
<form action="<?php echo JRoute::_('index.php?option=com_cimpay'); ?>" method="post" id="adminForm">
  <div style="display: none">
    <input type="hidden" name="task" value="recurring.dashboard" />
    <?php echo JHtml::_('form.token'); ?>
  </div>
  <table class="cimpay-recurring-dashboard" border="0">
    <tr>
      <td>
        
        <a href="<?php echo JRoute::_('index.php?option=com_cimpay&task=recurring_services.action_index'); ?>">
          <span class="icon-64-services">&#160;</span>
          Services
        </a>
      </td>
      <td>
        <a href="<?php echo JRoute::_('index.php?option=com_cimpay&task=recurring_packages.action_index'); ?>">
          <span class="icon-64-packages">&#160;</span>
          Packages
        </a>
      </td>
      <td>
        <a href="<?php echo JRoute::_('index.php?option=com_cimpay&task=recurring_customers.action_index'); ?>">
          <span class="icon-64-customers">&#160;</span>
          Customers
        </a>
      </td>
    </tr>
  </table>
</form>