<?php
require('config.php');

$tc = new \ThriveCart\Api('30d91fbae081c8ca9ab0e41990d0227d20d63a3c');

// $products = $tc->getProducts(array(
// 	'status' => 'live',
// ));

// print_r($products);

try {
  $product = $tc->getProduct(123456789);
} catch(\ThriveCart\Exception $e) {
  switch ($e->getCode()) {
    case '404':
      die('The requested product cannot not found.');
      break;
    
    default:
      die('Unknown error: '.$e->getMessage());
      break;
  }
}