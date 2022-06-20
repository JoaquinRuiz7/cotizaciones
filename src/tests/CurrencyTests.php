<?php
require_once './vendor/autoload.php';

use cotizaciones\domain\Currency;
use cotizaciones\domain\CurrencyQuotation;
use cotizaciones\domain\LastClose;
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

    public function testCurrencies()
    {
        $client = new Currency();
        $data = $client->get();

        $nodo = 'wsmonedasout.Linea';
        $monedas = $data->Salida->$nodo;
        $this->assertCount(40, $monedas);

    }

    public function testLastClose()
    {
        $client = new LastClose();
        $data = $client->get();

        $date = $data->Salida->Fecha;
        $this->assertNotNull($date);

    }
}