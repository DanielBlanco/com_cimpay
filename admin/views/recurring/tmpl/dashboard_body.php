<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach ($this->items as $i => $item): ?>
  <?php
    $months_collected = $this->getMonthsCollected($item->service_id);
    $months_with_transaction = $this->getMonthsWithTransaction($item->service_id);
    $months_to_collect = $item->service_duration - $months_collected;
    $months_without_transaction = $item->service_duration - $months_with_transaction;
  ?>
  <tr class="row<?php echo $i % 2; ?>">
    <td><?php echo $item->user_name; ?></td>
    <td><?php echo $item->user_email; ?></td>
    <td><?php echo $item->service_name; ?></td>
    <td><?php echo $this->getServiceStatus($item->service_id); ?></td>
    <td><?php echo $item->service_duration; ?></td>
    <td><?php echo $months_to_collect.' Months'; ?></td>
    <td><?php echo $months_without_transaction.' Months'; ?></td>
    <td style="color: blue"><?php echo $months_collected.' Months' ?></td>
  </tr>
<?php endforeach; ?>
