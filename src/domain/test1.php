<?php

require_once('vendor/autoload.php');

$client = new \cotizaciones\domain\Currency();
print_r($client->getAsXml());