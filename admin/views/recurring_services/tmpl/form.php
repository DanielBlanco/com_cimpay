<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
 
// load tooltip behavior
JHtml::_('behavior.tooltip');

$data =& $this->getModel();
?>
<form action="<?php echo JRoute::_('index.php?option=com_cimpay'); ?>" method="post" name="adminForm">
  <table cellpadding="0" cellspacing="3" border="0">
    <tr>
      <td>
        <label for="input-name">Name:</label>
      </td>
      <td>
        <input type="text" name="name" value="<?php echo $data->get('name') ?>" id="input-name" />
      </td>
      <td>Name of the service provided.</td>
    </tr>
    <tr>
      <td>
        <label for="input-description">Description:</label>
      </td>
      <td>
        <input type="text" name="description" value="<?php echo $data->get('description') ?>" id="input-description" />
      </td>
      <td>Description of the service provided.</td>
    </tr>
    <tr>
      <td>
        <label for="input-start-at">Start at:</label>
      </td>
      <td>
        <input type="text" name="start_at" value="<?php echo $data->get('start_at') ?>" id="input-start-at" />
      </td>
      <td>Date this service will be given to the customers (Format: YYYY-MM-DD).</td>
    </tr>
    <tr>
      <td>
        <label for="input-months-to-bill">Months to bill:</label>
      </td>
      <td>
        <input type="text" name="months_to_bill" value="<?php echo $data->get('months_to_bill') ?>" id="input-months-to-bill" />
      </td>
      <td>Number of months the service will last.</td>
    </tr>
    <tr>
      <td>
        <label for="input-cost-per-month">Cost per month:</label>
      </td>
      <td>
        <input type="text" name="cost_per_month" value="<?php echo $this->costPerMonth ?>" id="input-cost-per-month" />
      </td>
      <td>Amount to charge your customers per month (ie: 10, 9.99, etc).</td>
    </tr>
    <tr>
      <td>
        <label for="input-active">Active:</label>
      </td>
      <td>
        <select name="active" id="input-active">
          <option value="1" <?php echo ($data->get('active') == 1 ? 'checked="checked"' : '') ?>>Active</option>
          <option value="0" <?php echo ($data->get('active') == 0 ? 'checked="checked"' : '') ?>>Inactive</option>
        </select>
      </td>
      <td>If the service is active it is available for purchase.</td>
    </tr>
  </table>
  <div>
    <input type="hidden" name="id" value="<?php echo $data->get('id') ?>" />
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
  </div>
</form>
