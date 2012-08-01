<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach ($this->items as $i => $item): ?>
  <tr class="row<?php echo $i % 2; ?>" id="item-<?php echo $item->id; ?>">
    <td><?php echo $item->user_id; ?></td>
    <td><?php echo $item->profile_id; ?></td>
    <td><?php echo $item->payment_id; ?></td>
    <td><?php echo $item->shipping_id; ?></td>
    <td><?php echo $item->email; ?></td>
    <td><?php echo $item->name; ?></td>
    <td>
      <a href="<?php echo JRoute::_('index.php?option=com_cimpay&task=transactions.build&id=' . $item->id); ?>">
        New Transaction
      </a>
    </td>
  </tr>
<?php endforeach; ?>