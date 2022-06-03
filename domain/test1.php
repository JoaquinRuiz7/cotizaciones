<?php

require_once './vendor/autoload.php';
require_once './domain/CurrencyQuotation.php';

$client = new CurrencyQuotation();
$currency = $client->get([2225], '2022-06-01');
$aux = "datoscotizaciones.dato";
print_r($currency->Salida->datoscotizaciones->$aux);