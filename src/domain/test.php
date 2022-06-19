<?php
require_once './vendor/autoload.php';


use cotizaciones\domain\CurrencyQuotation;


$client = new CurrencyQuotation();

$data = $client->get([2225], '2022-06-17');
print_r($data);

