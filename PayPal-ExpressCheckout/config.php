<?php
//ob_start();
error_reporting(0);
session_start();

/* DATABASE CONFIGURATION */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_DATABASE', 'c1paypal');
define('DB_PASSWORD', 'magali2313');
define("BASE_URL", "http://cubemarket.fr/paypal/");

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



function getDB() 
{
	$dbhost=DB_SERVER;
	$dbuser=DB_USERNAME;
	$dbpass=DB_PASSWORD;
	$dbname=DB_DATABASE;
	$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbConnection->exec("set names utf8");
	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbConnection;
}
?>