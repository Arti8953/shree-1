<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Payment{

  private $CI;

  function __construct()
  {
      $this->CI = get_instance();
  }
  public function paytm()
  {
    $this->load->view('TxnTest');
  }

  public function hello(){
    echo "Hello";
  }

  public function paytmpost($paymet)
  {
  	 header("Pragma: no-cache");
  	 header("Cache-Control: no-cache");
  	 header("Expires: 0");

  	 // following files need to be included
  	 require_once(APPPATH . "libraries/Paytm/lib/config_paytm.php");
  	 require_once(APPPATH . "libraries/Paytm/lib/encdec_paytm.php");

  	 $checkSum = "";
  	 $paramList = array();

  	 $ORDER_ID = $paymet["ORDER_ID"];
  	 $CUST_ID = $paymet["CUST_ID"];
  	 $INDUSTRY_TYPE_ID = $paymet["INDUSTRY_TYPE_ID"];
  	 $CHANNEL_ID = $paymet["CHANNEL_ID"];
  	 $TXN_AMOUNT = $paymet["TXN_AMOUNT"];

  	// Create an array having all required parameters for creating checksum.
  	 $paramList["MID"] = 'yioOAF79378836826087';
  	 $paramList["ORDER_ID"] = $ORDER_ID;
  	 $paramList["CUST_ID"] = $CUST_ID;
  	 $paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
  	 $paramList["CHANNEL_ID"] = $CHANNEL_ID;
  	 $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
  	 $paramList["WEBSITE"] = 'dineoutWEB';

  	 /*
  	 $paramList["MSISDN"] = $MSISDN; //Mobile number of customer
  	 $paramList["EMAIL"] = $EMAIL; //Email ID of customer
  	 $paramList["VERIFIED_BY"] = "EMAIL"; //
  	 $paramList["IS_USER_VERIFIED"] = "YES"; //

  	 */
     $paytmParams = array(

      	/* Find your MID in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
      	"MID" => "yioOAF79378836826087",

      	/* this will be SUBSCRIBE */
      	"REQUEST_TYPE" => "SUBSCRIBE",

      	/* Find your WEBSITE in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
      	"WEBSITE" => "WEBSTAGING",

      	/* Find your INDUSTRY_TYPE_ID in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
      	"INDUSTRY_TYPE_ID" => "Retail",

      	/* WEB for website and WAP for Mobile-websites or App */
      	"CHANNEL_ID" => "WEB",

      	/* Enter your unique order id */
      	"ORDER_ID" => $ORDER_ID,

      	/* unique id that belongs to your customer */
      	"CUST_ID" => $CUST_ID,

      	/* customer's mobile number */
      	"MOBILE_NO" => "7905004391",

      	/* customer's email */
      	"EMAIL" => "example@gmail.com",

      	/**
      	* Amount in INR that is to be charged upfront at the time of creating subscription
      	* this should be numeric with optionally having two decimal points
      	*/
      	"TXN_AMOUNT" => $TXN_AMOUNT,

      	/* this is unique subscription id that belongs to your customer's subscription service */
      	"SUBS_SERVICE_ID" => $ORDER_ID,

      	/* enter subscription amount type here, possible value is either FIX or VARIABLE */
      	"SUBS_AMOUNT_TYPE" => 'FIX',

      	/* on completion of transaction, we will send you the response on this URL */
      	"CALLBACK_URL" => "http://localhost/essc/media/join/collback"

      );

  	//Here checksum string will return by getChecksumFromArray() function.
  	 $checkSum = getChecksumFromArray($paytmParams,'_fATwFSmd95qsU&3');
  	 echo "<html>
  	<head>
  	<title>Merchant Check Out Page</title>
  	</head>
  	<body>
  	    <center><h1>Please do not refresh this page...</h1></center>
  	        <form method='post' action='"."https://securegw-stage.paytm.in/order/process"."' name='f1'>
  	<table border='1'>
  	 <tbody>";

  	 foreach($paramList as $name => $value) {
  	 echo '<input type="hidden" name="' . $name .'" value="' . $value .         '">';
  	 }

  	 echo "<input type='hidden' name='CHECKSUMHASH' value='". $checkSum . "'>
  	 </tbody>
  	</table>
  	<script type='text/javascript'>
  	 document.f1.submit();
  	</script>
  	</form>
  	</body>
  	</html>";
   }
 }
 ?>
