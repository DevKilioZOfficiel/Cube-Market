<?php
			
			$this->db->where('id', $product['category']);
			$query_products__category = $this->db->get('products__category');
			foreach ($query_products__category->result() as $row_products__category){ ?>
			<?php
			$this->db->where('id', $product['user']);
			$query_products__user = $this->db->get('user');
			foreach ($query_products__user->result() as $row_products__user){ ?>
<?php function pseudo($commande,$pseudo) {
	    $commande = str_replace('{pseudo}', $pseudo, $commande);
        return $commande;
    } ?>	
<?php if($product['image'] == ""){
				  $image = "https://cdn.discordapp.com/attachments/480077879473078282/685527588827037774/unknown.png";
			  }else{
				  $image = $product['image']; 
			  }?>	
<!--page title start-->
<?php
function FileSizeConvert($bytes)
{
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "To",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "Go",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "Mo",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "Ko",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "o",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}

$this->db->where('id_product', $product['id']);
				$this->db->where('user', $user['id']);
			$this->db->from('products__payements');
			$verify__payement__existe = $this->db->count_all_results();
			
			
			$this->db->where('id_product', $product['id']);
			$this->db->from('products__payements');
			$count__payement = $this->db->count_all_results();
			
			$this->db->where('id_product', $product['id']);
			$this->db->from('products__updates');
			$count__updates = $this->db->count_all_results();
			
define('PRO_PayPal', '1');

if(PRO_PayPal == "0"){
	define("PayPal_CLIENT_ID", "#########################");
	define("PayPal_SECRET", "###################");
	define("PayPal_BASE_URL", "https://api.paypal.com/v1/");
}else{
	define("PayPal_CLIENT_ID", "Adv3TLdg5zo5Hl9QjT1EwGdW2uiRx3D0QDW18VC6oZoZfOZjAiUpz-pX-zw11W1A4Z4bnZDlzrp2Ozz3");
	define("PayPal_SECRET", "EM5pXosIkEhSeCnGxcSkd7vK5_9ueESbwC-C1fhVH_rz5QJjrlrQBihdn7puWQSVhzUS2stXlenQNE8H");
	define("PayPal_BASE_URL", "https://api.sandbox.paypal.com/v1/");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>

	<title>Paiement Paypal</title>

	<!-- Required meta tags always come first -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Paiement Paypal">
  <meta name="author" content="">
  <meta name="author" content="KilioZ">
  <meta name="revisit-after" content="15">
  <meta name="language" content="fr">
  <meta name="copyright" content="© 2020 Cubemarket">
  <meta name="robots" content="index, follow">
<style>
/**
 * Copyright (c) 2011 The Chromium Authors. All rights reserved.
 * Use of this source code is governed by a BSD-style license that can be
 * found in the LICENSE file.
 */
@font-face {
    font-family: Roboto-Thin;
    src: url('https://dev-time.eu/assets/share/Roboto/Roboto-Thin.ttf');
}

body {
  font-family: Roboto-Thin;
  background: #202224;
  margin: 0px;
  padding: 5px;
  color: #FFF;
}
.container {
    margin: 0 20px 20px 20px;
    
}

input[type=text] {
  font-family: Roboto-Thin;
  width: 100%;
  height: 40px;
  margin-bottom: 10px;
  padding-left: 10px;
  background: #181a1b;
  border: none;
  color: #fff;
  outline: none;
  font-size: 18px;
  font-weight: normal;
}
::-webkit-input-placeholder { /* WebKit browsers */
    color:    #DDD;
}
.services {
    width: 430px;
    margin-bottom: 95px;
}
h3 {
    margin-bottom: 5px;
}
.js-share-on img {
  width: 90px;
  height: 90px;
}
.js-share-on {
    position: relative;
    display: block;
    float: left;
    line-height: 45px;
    height: 45px;
    width: 45px;
    padding-right: 5px;
    padding-bottom: 5px;
    cursor: pointer;
}
.js-share-on img {
    display: block;
    position: absolute;
    margin:0;
    padding: 0;
    width: 45px;
    height: 45px;

}
.js-share-on.yes {

}
.js-share-on.yes .inactive {
    display: none;
}
.js-share-on .inactive {
    position: absolute;
    margin:0;
    padding: 0;
    width: 45px;
    height: 45px;
    z-index: 100;
    background: rgba(0,0,0, 0.5);
}
.clear {
    clear: both;
}

.button {
    background: #C1382A;
    cursor: pointer;
    border: none;
    display: block;
    height: 40px;
    width: 100%;
    color: #ffffff;
    text-align: center;
  	-webkit-transition: all 0.15s linear;
	  -moz-transition: all 0.15s linear;
	  transition: all 0.15s linear;
    font-size: 19px;
}

.button:hover {
    background: #E74C3C;
}
.thanks {
    text-align: right;
    color: #FFF;
    font-size: 13px;
}
a {
    color: #FFF;
    font-weight: bold;
}


.alert {
    position: relative;
    padding: 0.75rem 1rem;
    margin-bottom: 1rem;
}

.alert-success {
  font-family: Roboto-Thin;
  width: 98.5%;
  height: auto;
  margin-bottom: 10px;
  padding-left: 10px;
  background: #06611a;
  border: none;
  color: #fff;
  outline: none;
  font-size: 18px;
  font-weight: normal;
  padding: 5px;
}

.alert-danger {
  font-family: Roboto-Thin;
  width: 98.5%;
  height: auto;
  margin-bottom: 10px;
  padding-left: 10px;
  background: #610606;
  border: none;
  color: #fff;
  outline: none;
  font-size: 18px;
  font-weight: normal;
  padding: 5px;
}
</style>


</head>
<body class="page-has-left-panels page-has-right-panels" id="testarea" oncontextmenu="return false" onkeydown="return false;" onmousedown="return false;">

<form method="POST">
    <div class="container">
			
      <div class="">
        <h1><?= $product['title']; ?></h1>
      </div>
      <div class="form-item">
        <input id="payement_prix" readonly name="payement_prix" type="text" value="€ <?= $product['price']; ?> EUR" placeholder="Prix" />
      </div>
	  <?php if(empty($row_products__user->paypal__client)){ ?>
	  <div class="alert-danger">Le vendeur n'a pas configuré le paiement Paypal sur son compte</div>
	  <?php }else{ ?>
      <div id="paypalbuttoncontainer"></div>
      <script src="https://www.paypalobjects.com/api/checkout.js"></script>
      <script>
        paypal.Button.render({
             
            env: 'production',
            
            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                sandbox:    '<?= $row_products__user->paypal__client; ?>',
                production: '<?= $row_products__user->paypal__client; ?>'
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {
                
                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: '<?= $product['price']; ?>', currency: 'EUR' }
                            }
                        ]
                    }
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment
                return actions.payment.execute().then(function() {
                    console.log('Payment Complete!');
        
                    window.location = "<?= base_url(); ?>products/payement/?paymentID="+data.paymentID+"&payerID="+data.payerID+"&token="+data.paymentToken+"&pid=<?= $product['id']; ?>&price=<?= $product['price']; ?>";

                });
            }


        }, '#paypalbuttoncontainer');

    </script>
	  <?php } ?>
    </div>
</form>
</body>
</html>
						<?php } ?>
			<?php } ?>