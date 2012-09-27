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
    <td><?php echo $item->name; ?></td>
    <td><?php echo $item->description; ?></td>
    <td><?php echo $item->active == 1 ? 'Active' : 'Inactive'; ?></td>
    <td><?php echo $item->start_at; ?></td>
    <td><?php echo $item->months_to_bill; ?></td>
    <td><?php echo $item->total_cost; ?></td>
    <td style="text-align: center">
      <a href="<?php echo JRoute::_('index.php?option=com_cimpay&task=recurring_services.action_edit&id=' . $item->id); ?>" title="Edit this service">
        <span class="icon-16-edit">&#160;</span>
      </a>
    </td>
  </tr>
<?php endforeach; ?>
