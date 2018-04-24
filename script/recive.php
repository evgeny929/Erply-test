<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

# Connect to API ERPLY
# include ERPLY API class
include("../include/EAPI.class.php");

use PhpAmqpLib\Connection\AMQPStreamConnection;
 
# Create connection
$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
 
# The first argument is the name
$channel = $connection->channel();
$channel->queue_declare('product', false, false, false, false);
 
echo 'Waiting for input products', "\n";

$callback = function($msg) {
	
	
    echo " New product input: ", $msg->body, "\n";
	$productName = $msg->body;
	
	# Initialise class
	$api = new EAPI();

	# Configuration settings
	$api->clientCode = 399035;
	$api->username = "evgeny929@gmail.com";
	$api->password = "29031993Jeka";
	$api->url = "https://".$api->clientCode.".erply.com/api/";
	# Product Group
	$groupID_product = 2;
	
	$inputs = array(
		"searchName" => $productName,
	);

	# Get client products
	# Input parameters name of product
	$result = $api->sendRequest("getProducts", $inputs);
	
	# Default output format is JSON, so we'll decode it into a PHP array
	$output = json_decode($result, true);

	if($output['status']['recordsInResponse']==0 and $output['status']['errorCode']==0){
		
		echo 'New product registed!'; echo "\n";

		$inputs = array(
			"name" => $productName,
			"groupID" => $groupID_product
		);
		$result = $api->sendRequest("saveProduct", $inputs);
	}else {
		echo 'Product already exists!'; echo "\n";
	}
};
 
# Listern 
$channel->basic_consume('product', '', false, true, false, false, $callback);
while(count($channel->callbacks)) {
    $channel->wait();
}
 
# Close connection
$channel->close();
$connection->close();
 
?>