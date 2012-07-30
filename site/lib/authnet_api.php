<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Cimpay Helper for Authorize.net API.
 */
class AuthnetApi
{

  public $authnet_login = '';
  public $authnet_transaction_key = '';
  public $authnet_api_host ='';
  public $authnet_api_path = '';
  
  public $customer_profile_id = '';
  public $customer_payment_id = '';
  public $customer_address_id = '';

  public $customer_id = '';
  public $email = '';
  public $first_name = '';
  public $last_name = '';
  public $company = '';
  public $address = '';
  public $city = '';
  public $state = '';
  public $zip = '';
  public $country = '';
  public $phone_number = '';
  public $fax_number = '';
  public $cc_card_number = '';
  public $cc_expiration_date = '';

  public $errors = array();

  /**
   * Create the customer profile ID.
   */
  public function create_customer_profile()
  {
    $xml = 
      "<?xml version=\"1.0\" encoding=\"utf-8\"?>".
      "<createCustomerProfileRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">".
      $this->merchant_authentication_block().
      "<profile>".
      "<merchantCustomerId>".$this->customer_id."</merchantCustomerId>". // Your own identifier for the customer.
      "<description></description>".
      "<email>" . $this->email . "</email>".
      "</profile>".
      "</createCustomerProfileRequest>";
    $r = $this->send_xml_request($xml);
    $r = $this->parse_api_response($r);
    if ("Ok" == $r->messages->resultCode) {
      $this->customer_profile_id = (String)$r->customerProfileId;
      return true;
    } else {
      return false;
    }
  }

  /**
   * Create the customer payment profile ID.
   */
  public function create_payment_profile()
  {
    $xml =
      "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
      "<createCustomerPaymentProfileRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
      $this->merchant_authentication_block().
      "<customerProfileId>" . $this->customer_profile_id . "</customerProfileId>".
      "<paymentProfile>".
      "<billTo>".
       "<firstName>".$this->first_name."</firstName>".
       "<lastName>".$this->last_name."</lastName>".
       "<company>".$this->company."</company>".
       "<address>".$this->address."</address>".
       "<city>".$this->city."</city>".
       "<state>".$this->state."</state>".
       "<zip>".$this->zip."</zip>".
       "<country>".$this->country."</country>".
       "<phoneNumber>".$this->phone_number."</phoneNumber>".
       "<faxNumber>".$this->fax_number."</faxNumber>".
      "</billTo>".
      "<payment>".
       "<creditCard>".
        "<cardNumber>".$this->cc_card_number."</cardNumber>".
        "<expirationDate>".$this->cc_expiration_date."</expirationDate>". // required format for API is YYYY-MM
       "</creditCard>".
      "</payment>".
      "</paymentProfile>".
      "<validationMode>liveMode</validationMode>". // or testMode
      "</createCustomerPaymentProfileRequest>";
    $response = $this->send_xml_request($xml);
    $parsed_response = $this->parse_api_response($response);
    if ("Ok" == $parsed_response->messages->resultCode) {
      $this->customer_payment_id = (String)$parsed_response->customerPaymentProfileId;
      return true;
    } else {
      return false;
    }
  }

  /**
   * Create the customer shipping address ID.
   */
  public function create_shipping_address() {
    $xml =
      "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
      "<createCustomerShippingAddressRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
      $this->merchant_authentication_block().
      "<customerProfileId>" . $this->customer_profile_id . "</customerProfileId>".
      "<address>".
      "<firstName>".$this->first_name."</firstName>".
      "<lastName>".$this->last_name."</lastName>".
      "<company>".$this->company."</company>".
      "<address>".$this->address."</address>".
      "<city>".$this->city."</city>".
      "<state>".$this->state."</state>".
      "<zip>".$this->zip."</zip>".
      "<country>".$this->country."</country>".
      "<phoneNumber>".$this->phone_number."</phoneNumber>".
      "<faxNumber>".$this->fax_number."</faxNumber>".
      "</address>".
      "</createCustomerShippingAddressRequest>";
    $response = $this->send_xml_request($xml);
    $parsed_response = $this->parse_api_response($response);
    if ("Ok" == $parsed_response->messages->resultCode) {
      $this->customer_address_id = (String)$parsed_response->customerAddressId;
      return true;
    } else {
      return false;
    }
  }

  /**
   * Get the merchant authentication block.
   */
  public function merchant_authentication_block()
  {
    return
          "<merchantAuthentication>".
          "<name>" . $this->authnet_login . "</name>".
          "<transactionKey>" . $this->authnet_transaction_key . "</transactionKey>".
          "</merchantAuthentication>";
  }

  //function to send xml request to Api.
  //There is more than one way to send https requests in PHP.
  public function send_xml_request($content)
  {
    return $this->send_request_via_fsockopen($content);
  }

  /**
   * Function to send xml request via fsockopen
   * It is a good idea to check the http status code.
   */
  public function send_request_via_fsockopen($content)
  {

    $posturl = "ssl://" . $this->authnet_api_host;
    $header = "Host: $this->authnet_api_host\r\n";
    $header .= "User-Agent: PHP Script\r\n";
    $header .= "Content-Type: text/xml\r\n";
    $header .= "Content-Length: ".strlen($content)."\r\n";
    $header .= "Connection: close\r\n\r\n";
    $fp = fsockopen($posturl, 443, $errno, $errstr, 30);
    if (!$fp)
    {
      $body = false;
    }
    else
    {
      error_reporting(E_ERROR);
      fputs($fp, "POST $this->authnet_api_path  HTTP/1.1\r\n");
      fputs($fp, $header.$content);
      fwrite($fp, $out);
      $response = "";
      while (!feof($fp))
      {
        $response = $response . fgets($fp, 128);
      }
      fclose($fp);
      error_reporting(E_ALL ^ E_NOTICE);
      
      $len = strlen($response);
      $bodypos = strpos($response, "\r\n\r\n");
      if ($bodypos <= 0)
      {
        $bodypos = strpos($response, "\n\n");
      }
      while ($bodypos < $len && $response[$bodypos] != '<')
      {
        $bodypos++;
      }
      $body = substr($response, $bodypos);
    }
    return $body;
  }


  /**
   *function to send xml request via curl
   */
  public function send_request_via_curl($content)
  {
    $posturl = "https://" . $this->authnet_api_host . $this->authnet_api_path;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $posturl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    return $response;
  }

  /**
   * Function to parse the api response
   * The code uses SimpleXML. http://us.php.net/manual/en/book.simplexml.php 
   * There are also other ways to parse xml in PHP depending on the version 
   * and what is installed.
   */
  public function parse_api_response($content)
  {
    $parsedresponse = simplexml_load_string($content, "SimpleXMLElement", LIBXML_NOWARNING);
    if ("Ok" != $parsedresponse->messages->resultCode) {
      foreach ($parsedresponse->messages->message as $msg) {
        $this->errors[] = '['.htmlspecialchars($msg->code).'] '.htmlspecialchars($msg->text);
      }
    }
    return $parsedresponse;
  }

}