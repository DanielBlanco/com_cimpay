<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
 
// load tooltip behavior
JHtml::_('behavior.tooltip');

$data =& $this->getModel();
?>
<form action="index.php" method="post" name="adminForm">
  <table cellpadding="0" cellspacing="3" border="0">
    <tr>
      <td>
        <label for="input-service">Service:</label>
      </td>
      <td>
        <select name="service_id" id="input-service">
          <?php foreach ($this->services as $i => $item): ?>
            <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
          <?php endforeach; ?>
        </select>
      </td>
      <td>Name of the service to offer.</td>
    </tr>
    <tr>
      <td>
        <label for="input-name">Name:</label>
      </td>
      <td>
        <input type="text" name="name" value="<?php echo $data->get('name') ?>" id="input-name" />
      </td>
      <td>Name of the package.</td>
    </tr>
    <tr>
      <td>
        <label for="input-description">Description:</label>
      </td>
      <td>
        <input type="text" name="description" value="<?php echo $data->get('description') ?>" id="input-description" />
      </td>
      <td>Description of the package.</td>
    </tr>
    <tr>
      <td>
        <label for="input-months-to-pay">Months to pay:</label>
      </td>
      <td>
        <input type="text" name="months_to_pay" value="<?php echo $data->get('months_to_pay') ?>" id="input-months-to-pay" />
      </td>
      <td>Number of months the package will pay.</td>
    </tr>
    <tr>
      <td>
        <label for="input-recurring">Recurring:</label>
      </td>
      <td>
        <input type="text" name="recurring" value="<?php echo ($data->get('recurring') == 1 ? 'true' : 'false' ) ?>" id="input-recurring" />
      </td>
      <td>True if this is a recurring payment package.</td>
    </tr>
    <tr>
      <td>
        <label for="input-discount">Discount:</label>
      </td>
      <td>
        <input type="text" name="discount" value="<?php echo $data->get('discount') ?>" id="input-discount" />
      </td>
      <td>Discount to apply to this package invoices.</td>
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
      <td>If the package is active it is available for purchase.</td>
    </tr>
  </table>
  <div>
    <input type="hidden" name="option" value="com_cimpay"/>
    <input type="hidden" name="id" value="<?php echo $data->get('id') ?>" />
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
  </div>
</form>
