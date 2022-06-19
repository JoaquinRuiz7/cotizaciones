<?php
require_once './vendor/autoload.php';

use cotizaciones\domain\CurrencyQuotation;
use PHPUnit\Framework\TestCase;

class CurrencyTests extends TestCase
{

    public function testDollarQuotation()
    {
        $client = new CurrencyQuotation();
        $data = $client->get([2225], '2022-06-17');

        $nodo = 'datoscotizaciones.dato';
        $moneda = $data->Salida->datoscotizaciones->$nodo->Moneda;
        $valor = $data->Salida->datoscotizaciones->$nodo->TCC;

        $this->assertEquals(2225, $moneda);
        $this->assertEquals(40.105, $valor);

    }
}