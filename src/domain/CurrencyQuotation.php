<?php

namespace cotizaciones\domain;

use Spatie\ArrayToXml\ArrayToXml;
use stdClass;

class CurrencyQuotation extends BcuClient
{

    const BCU_LOCATION = 'https://cotizaciones.bcu.gub.uy/wscotizaciones/servlet/awsbcucotizaciones';
    const BCU_ACTION = 'Cotizaaction/AWSBCUCOTIZACIONES.Execute';

    public function getAsXml(array $currency, string $date): string
    {

        $soapEnv = [
            'soapenv:Header' => '',
            'soapenv:Body' => [
                "wsbcucotizaciones.Execute" => [
                    'Entrada' => [
                        'Moneda' => ['item' => $currency],
                        'FechaDesde' => $date,
                        'FechaHasta' => $date,
                        'Grupo' => 0,
                    ]
                ],
            ],
        ];

        $xml = ArrayToXml::convert($soapEnv, $this->envelopeHeader(), true, 'UTF-8', '1.0', ['formatOutput' => true]);

        return $this->client->__doRequest($xml, self::BCU_LOCATION, self::BCU_ACTION, '1.0');
    }

    public function get(array $currency, string $date): StdClass
    {
        $requestBody = [
            'Entrada' => [
                'Moneda' => ['item' => $currency],
                'FechaDesde' => $date,
                'FechaHasta' => $date,
                'Grupo' => 0,
            ],
        ];

        return $this->client->Execute($requestBody);

    }

    protected function getWSDL(): string
    {
        return 'https://cotizaciones.bcu.gub.uy/wscotizaciones/servlet/awsbcucotizaciones?wsdl';
    }
}