<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
 
// load tooltip behavior
JHtml::_('behavior.tooltip');
?>
<form action="index.php" method="post" id="adminForm">
  <table class="adminlist">
    <thead><?php echo $this->loadTemplate('head');?></thead>
    <tfoot><?php echo $this->loadTemplate('foot');?></tfoot>
    <tbody><?php echo $this->loadTemplate('body');?></tbody>
  </table>
  <div>
    <input type="hidden" name="option" value="com_cimpay" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="task" value="recurring.dashboard" />
    <?php echo JHtml::_('form.token'); ?>
  </div>
</form>