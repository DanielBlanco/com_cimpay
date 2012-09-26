<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach ($this->items as $i => $item): ?>
  <tr class="row<?php echo $i % 2; ?>" id="item-<?php echo $item->id; ?>">
    <td style="white-space: nowrap"><?php echo $item->item_name; ?></td>
    <td style="white-space: nowrap"><?php echo $item->billing_date; ?></td>
    <td style="font-weight: bold">$<?php echo $item->amount; ?></td>
    <td><?php echo $item->status != 0 ? 'Collected' : 'Pending'; ?></td>
  </tr>
<?php endforeach; ?>