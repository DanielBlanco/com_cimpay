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
        <label for="input-customer">Customer:</label>
      </td>
      <td>
        <select name="customer_id" id="input-customer">
          <?php foreach ($this->customers as $i => $item): ?>
            <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
          <?php endforeach; ?>
        </select>
      </td>
      <td>Customer to bill.</td>
    </tr>
    <tr>
      <td>
        <label for="input-package">Package:</label>
      </td>
      <td>
        <select name="package_id" id="input-package">
          <?php foreach ($this->packages as $i => $item): ?>
            <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
          <?php endforeach; ?>
        </select>
      </td>
      <td>Payment package to use.</td>
    </tr>
  </table>
  <div>
    <input type="hidden" name="option" value="com_cimpay"/>
    <input type="hidden" name="id" value="<?php echo $data->get('id') ?>" />
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
  </div>
</form>
