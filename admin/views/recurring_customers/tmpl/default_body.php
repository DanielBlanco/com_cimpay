<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach ($this->items as $i => $item): ?>
  <?php 
    $checked = JHTML::_( 'grid.id', $i, $item->id );
  ?>
  <tr class="row<?php echo $i % 2; ?>" id="item-<?php echo $item->id; ?>">
    <td><?php echo $checked; ?></td>
    <td><?php echo $item->id; ?></td>
    <td><?php echo $item->user_name; ?></td>
    <td><?php echo $item->user_email; ?></td>
    <td><?php echo $item->service_name; ?></td>
    <td><?php echo $item->package_name; ?></td>
  </tr>
<?php endforeach; ?>
