<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
$service_display = 0;
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
    <table border="0" cellpadding="3" cellspacing="3" style="width:100%">
      <tbody>
        <?php foreach ($this->packages as $i => $item): ?>
          <?php 
          $cost_per_month = ($item->total_cost / $item->months_to_bill);
          $discount = ($cost_per_month * ($item->discount/100));
          $package_price = ($cost_per_month * $item->months_to_pay) - $discount;
          ?>
          <?php if ($item->service_id != $service_display): ?>
            <?php $service_display = $item->service_id; ?>
            <tr>
              <td style="white-space: nowrap" width="5%">&#160;</td>
              <td style="white-space: nowrap" width="95%">
                <h3><?php echo $item->service_name ?></h3>
                <p><?php echo $item->service_description ?></p>
              </td>
            </tr>
          <?php endif; ?>
          <tr>
            <td style="text-align:center"><input type="radio" name="cimpay_service" id="cimpay-service-<?php echo $item->id ?>" value="<?php echo $item->id ?>"/></td>
            <td>
              <label for="cimpay-service-<?php echo $item->id ?>">
                <span style="font-weight:bold"><?php echo $item->name ?>:</span>
                <?php echo $item->description ?>
                <br/>
                <span class="cimpay-fe-package-price-h">Price:</span>
                <span class="cimpay-fe-package-price">$<?php echo $package_price ?>&#160;<?php echo ($item->recurring == 1 ? '(Recurring)' : '(One time payment)') ?></span>
              </label>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
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

