<?php
require 'config.php';
require 'session.php';
require 'class/paypalExpress.php';
$paypalExpress = new paypalExpress();
$orders = $paypalExpress->orders();
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/main.css" rel="stylesheet">
    <title>PayPal Express Checkout using PHP</title>

  </head>

  <body>
    <h1>PHP PayPal Express Checkout Demo</h1>
    <div> <a href="logout.php" class="logout">Logout</a> </div>
    <h2>Orders</h2>
    <?php if($orders) { ?>
    <table>
       <?php foreach($orders as $order){  ?>
        <tr>
          <td>ORDER - <?php echo $order->oid; ?></td>
          <td><?php echo $order->product; ?></td>
          <td><?php echo $order->price.' '.$order->currency; ?></td>
          <td><?php echo $paypalExpress->timeFormat($order->created); ?></td>
        </tr>
		
		<?php
	   $paymentID = "PAY-75R31998X3933340BLG777KY";
	   $payerID = "8B6CEM33UZFFG";
	   $paymentToken = "EC-8CN890966V0309306";
	   
	   
	   $ch = curl_init();
    $clientId = "Adv3TLdg5zo5Hl9QjT1EwGdW2uiRx3D0QDW18VC6oZoZfOZjAiUpz-pX-zw11W1A4Z4bnZDlzrp2Ozz3";
    $secret = "EM5pXosIkEhSeCnGxcSkd7vK5_9ueESbwC-C1fhVH_rz5QJjrlrQBihdn7puWQSVhzUS2stXlenQNE8H";
    curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.paypal.com/v1/oauth2/token');
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $clientId . ":" . $secret);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    $result = curl_exec($ch);
    $accessToken = null;
    
    
    if (empty($result)){
        return false;
    }else {
        $json = json_decode($result);
        $accessToken = $json->access_token;
        $curl = curl_init('https://api.sandbox.paypal.com/v1/payments/payment/' . $paymentID);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $accessToken,
        'Accept: application/json',
        'Content-Type: application/xml'
        ));
        $response = curl_exec($curl);
        $result = json_decode($response);
        
        
        $state = $result->state;
        $total = $result->transactions[0]->amount->total;
        $currency = $result->transactions[0]->amount->currency;
        $subtotal = $result->transactions[0]->amount->details->subtotal;
        $recipient_name = $result->transactions[0]->item_list->shipping_address->recipient_name;
        curl_close($ch);
        curl_close($curl);
        
        $product = $this->getProduct($pid);    
	?>
	
		<tr>
		    <td><?= $state; ?></td>
		    <td><?= $total; ?></td>
		    <td><?= $currency; ?></td>
		    <td><?= $subtotal; ?></td>
		    <td><?= $recipient_name; ?></td>
		    <td><?= $result; ?></td>
		</tr>
	<?php } ?>
        <?php } ?>
    </table>
    <?php }  else { ?>
      <div> No Orders</div>
      <?php } ?>

  </body>
  </html>