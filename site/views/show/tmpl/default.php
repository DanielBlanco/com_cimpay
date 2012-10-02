<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<h1>Your Payment Profile</h1>
<div class="cimpay-user-show">
  <p>Thank you for subscribing to Predator USA automatic payments!!</p>
  <h2>Your Transactions:</h2>
  <table class="cimpay-site-customer-transactions-table" style="width:100%">
    <thead><?php echo $this->loadTemplate('transactions_head');?></thead>
    <tfoot><?php echo $this->loadTemplate('transactions_foot');?></tfoot>
    <tbody><?php echo $this->loadTemplate('transactions_body');?></tbody>
  </table>
  </br>
  </br>
  <h2>Services Available:</h2>
  <form id="cimpay-buy-service" action="index.php" method="post" class="cimpay-form">
    <label for="cimpay-service">Service:</label>
    <select name="cimpay_service" id="cimpay-service">
      <?php foreach ($this->packages as $i => $item): ?>
        <option value="<?php echo $item->id ?>"><?php echo $item->service_name ?> - <?php echo $item->name ?></option>
      <?php endforeach; ?>
    </select>
    <br/>
    <button type="submit" name="submit">Buy!</button>
    <div>
      <input type="hidden" name="customer" value=""/>
      <input type="hidden" name="option" value="com_cimpay"/>
      <input type="hidden" name="task" value="buy_service" />
      <?php echo JHtml::_('form.token'); ?>
    </div>
  </form>
  <br/>
  <p>
    <b>Please Remember:</b>
    <ul>
      <li>Predator USA does NOT store credit card information.</li>
      <li>If a charge is done to your Credit Card an Email Receipt will be sent to the email address that you provided.</li>
      <li>To cancel your subscription send an email to info@predatorusa.com.</li>
    </ul>
  </p>
</div>

