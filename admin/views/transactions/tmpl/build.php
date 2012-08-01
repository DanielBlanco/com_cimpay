<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
 
// load tooltip behavior
JHtml::_('behavior.tooltip');
?>
<form action="<?php echo JRoute::_('index.php?option=com_cimpay'); ?>" method="post" name="adminForm">
  <div>
    <input type="hidden" name="id" value="<?php echo $this->item->id ?>" />
    <input type="hidden" name="task" value="transactions.create" />
    <?php echo JHtml::_('form.token'); ?>
  </div>
  <table cellpadding="0" cellspacing="3" border="0">
    <tr>
      <td>
        <label for="input-amount">Amount to charge:</label>
      </td>
      <td>
        <input type="text" name="amount" value="1.00" id="input-amount" />
      </td>
      <td>Up to 4 digits after the decimal point (no dollar symbol) For example, 12.99 or 12.9999.</td>
    </tr>
    <tr>
      <td>
        <label for="input-billing-date">Billing Date</label>
      </td>
      <td>
        <input type="text" name="billing_date" value="<?php echo date('Y-m-d'); ?>" id="input-billing-date" />
      </td>
      <td>The billing date. Format YYYY-MM-DD.</td>
    </tr>
    <tr>
      <td colspan="3"><hr/></td>
    </tr>
    <tr>
      <td colspan="3" style="font: bold 14px Verdana;">SHIPPING DETAILS</td>
    </tr>
    <tr>
      <td>
        <label for="input-shipping-amount">Amount</label>
      </td>
      <td>
        <input type="text" name="shipping_amount" value="0.00" id="input-shipping-amount" />
      </td>
      <td>This amount must be included in the total amount for the transaction.</td>
    </tr>
    <tr>
      <td>
        <label for="input-shipping-name">Name</label>
      </td>
      <td>
        <input type="text" name="shipping_name" value="No Shipping" id="input-shipping-name" />
      </td>
      <td>The name of the shipping for the transaction.</td>
    </tr>
    <tr>
      <td>
        <label for="input-shipping-description">Description</label>
      </td>
      <td>
        <input type="text" name="shipping_description" value="Do not require shipping." id="input-shipping-description" />
      </td>
      <td>The shipping description for the transaction.</td>
    </tr>
    <tr>
      <td colspan="3"><hr/></td>
    </tr>
    <tr>
      <td colspan="3" style="font: bold 14px Verdana;">PRODUCT DETAILS</td>
    </tr>
    <tr>
      <td>
        <label for="input-item-id">Item Id</label>
      </td>
      <td>
        <input type="text" name="item_id" value="" id="input-item-id" />
      </td>
      <td>The ID assigned to the item in your local system.</td>
    </tr>
    <tr>
      <td>
        <label for="input-item-name">Item Name</label>
      </td>
      <td>
        <input type="text" name="item_name" value="" id="input-item-name" />
      </td>
      <td>A short description of the item.</td>
    </tr>
    <tr>
      <td>
        <label for="input-item-description">Item Description</label>
      </td>
      <td>
        <input type="text" name="item_description" value="" id="input-item-description" />
      </td>
      <td>A detailed description of the item.</td>
    </tr>
    <tr>
      <td>
        <label for="input-item-quantity">Item Quantity</label>
      </td>
      <td>
        <input type="text" name="item_quantity" value="1" id="input-item-quantity" />
      </td>
      <td>The number of this item sold.</td>
    </tr>
    <tr>
      <td>
        <label for="input-item-unit-price">Unit Price</label>
      </td>
      <td>
        <input type="text" name="item_unit_price" value="1.00" id="input-item-unit-price" />
      </td>
      <td>Cost of an item per unit excluding tax, freight, and duty.</td>
    </tr>
    <tr>
      <td colspan="3"><hr/></td>
    </tr>
    <tr>
      <td colspan="3" style="font: bold 14px Verdana;">ORDER DETAILS</td>
    </tr>
    <tr>
      <td>
        <label for="input-order-invoice-number">Invoice Number</label>
      </td>
      <td>
        <input type="text" name="order_invoice_number" value="" id="input-order-invoice-number" />
      </td>
      <td>The merchant assigned invoice number for the transaction.</td>
    </tr>
    <tr>
      <td colspan="3"><hr/></td>
    </tr>
  </table>
</form>