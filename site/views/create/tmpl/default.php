<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<h1>Auto-Payment Profile</h1>

<form id="cimpay-create-profile" action="?option=com_cimpay" method="post" class="cimpay-form">
  <input type="hidden" name="task" value="create" />
  <?php if (count($this->errors) > 0): ?>
    <ul class="cimpay-error-list">
      <?php foreach ($this->errors as $error): ?>
        <li><?php echo $error; ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  <table cellpadding="0" cellspacing="3" border="0">
    <tr>
      <td>
        <label for="authnet-profile-email">Email</label>
      </td>
      <td>
        <input type="text" name="email" value="<?php echo $this->email; ?>" id="authnet-profile-email" readonly="readonly" />
      </td>
      <td>Your user account email address.</td>
    </tr>
    <tr>
      <td>
        <label for="authnet-profile-first-name">First Name</label>
      </td>
      <td>
        <input type="text" name="first_name" value="<?php echo $this->first_name; ?>" id="authnet-profile-first-name" />
      </td>
      <td>Your first name ie: John</td>
    </tr>
    <tr>
      <td>
        <label for="authnet-profile-last-name">Last Name</label>
      </td>
      <td>
        <input type="text" name="last_name" value="<?php echo $this->last_name; ?>" id="authnet-profile-last-name" />
      </td>
      <td>Your last name ie: Doe</td>
    </tr>
    <tr>
      <td>
        <label for="authnet-profile-address">Address</label>
      </td>
      <td>
        <input type="text" name="address" value="" id="authnet-profile-address" />
      </td>
      <td>Your billing address.</td>
    </tr>
    <tr>
      <td>
        <label for="authnet-profile-city">City</label>
      </td>
      <td>
        <input type="text" name="city" value="" id="authnet-profile-city" />
      </td>
      <td>Your billing City.</td>
    </tr>
    <tr>
      <td>
        <label for="authnet-profile-state">State</label>
      </td>
      <td>
        <input type="text" name="state" value="" id="authnet-profile-state" />
      </td>
      <td>Your billing State.</td>
    </tr>
    <tr>
      <td>
        <label for="authnet-profile-zip">ZIP</label>
      </td>
      <td>
        <input type="text" name="zip" value="" id="authnet-profile-zip"/>
      </td>
      <td>Your billing Zip code ie: 98004.</td>
    </tr>
    <tr>
      <td>
        <label for="authnet-profile-country">Country</label>
      </td>
      <td>
        <input type="text" name="country" value="United States of America" id="authnet-profile-country" readonly="readonly" />
      </td>
      <td>Your billing Country.</td>
    </tr>
    <tr>
      <td>
        <label for="authnet-profile-phone-number">Phone Number</label>
      </td>
      <td>
        <input type="text" name="phone_number" value="" id="authnet-profile-phone-number" placeholder="000-000-0000" />
      </td>
      <td>Your phone number ie: 000-000-0000</td>
    </tr>
    <tr>
      <td colspan="3"><hr/></td>
    </tr>
    <tr>
      <td>
        <label for="authnet-profile-cc-card-number">Card Number</label>
      </td>
      <td>
        <input type="text" name="cc_card_number" value="" id="authnet-profile-cc-card-number" />
      </td>
      <td>Your Credit Card number ie: 4111111111111111</td>
    </tr>
    <tr>
      <td>
        <label for="authnet-profile-cc-expiration-date">Card Number</label>
      </td>
      <td>
        <input type="text" name="cc_expiration_date" value="" id="authnet-profile-cc-expiration-date" />
      </td>
      <td>Your Credit Card expiration date ie: 2020-11 (format YYYY-MM)</td>
    </tr>
    <tr>
      <td colspan="3"><hr/></td>
    </tr>
    <tr>
      <td colspan="3">
        <b class="cimpay-important">Please note: </b>
        <ul>
          <li>All fields are required.</li>
          <li>Predator USA does NOT store credit card information.</li>
          <li>All the information you enter here will be sent to Authorize.net for safe keeping.</li>
          <li>If a charge is done to your Credit Card an Email Receipt will be sent to the email address that you provided.</li>
          <li>By clicking "Save my profile" button you are accepting that we can charge your credit card at anytime.</li>
        </ul>
      </td>
    </tr>
  </table>
  <p>
    <button name="submit" type="submit">Save my Profile</button>
  </p>
</form>