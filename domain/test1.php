<?php

require_once './domain/CurrencyQuotation.php';
require_once './domain/Currency.php';
require_once './domain/LastClose.php';
require_once './vendor/autoload.php';

$client = new LastClose();
$client->get();
