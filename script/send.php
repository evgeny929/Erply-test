<?php
 
require_once __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
 
#Connection
$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

#The first argument is the name
$channel = $connection->channel();
$channel->queue_declare('product', false, false, false, false);
 
#New message
$msg = new AMQPMessage($_POST["product"]);
#Send to queue
$channel->basic_publish($msg, '', 'product');

 
#Colse connection
$channel->close();
$connection->close();

header("Location: ../index.php");
exit();
 
?>