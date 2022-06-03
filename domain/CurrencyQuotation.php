<?php

use Spatie\ArrayToXml\ArrayToXml;

class CurrencyQuotation
{

    const BCU_WSDL = 'https://cotizaciones.bcu.gub.uy/wscotizaciones/servlet/awsbcucotizaciones?wsdl';
    const BCU_LOCATION = 'https://cotizaciones.bcu.gub.uy/wscotizaciones/servlet/awsbcucotizaciones';
    const BCU_ACTION = 'Cotizaaction/AWSBCUCOTIZACIONES.Execute';
    public SoapClient $client;

    public function __construct()
    {
        $this->client = new SoapClient(self::BCU_WSDL);
    }

    public function getAsXml(array $currency, string $date)
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

    public function get(array $currency, string $date)
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

    private function envelopeHeader()
    {
        return [
            'rootElementName' => 'soapenv:Envelope',
            '_attributes' => [
                'xmlns:soapenv' => 'http://schemas.xmlsoap.org/soap/envelope/',
                'xmlns' => 'Cotiza',
            ]
        ];
    }
}