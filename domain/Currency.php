<?php

use Spatie\ArrayToXml\ArrayToXml;

class Currency
{
    const WSDL = 'https://cotizaciones.bcu.gub.uy/wscotizaciones/servlet/awsbcumonedas?wsdl';
    const BCU_LOCATION = 'https://cotizaciones.bcu.gub.uy/wscotizaciones/servlet/awsbcumonedas';
    const BCU_ACTION = 'Cotizaaction/AWSBCUMONEDAS.Execute';
    public SoapClient $client;

    public function __construct()
    {
        $this->client = new SoapClient(self::WSDL);
    }

    public function get()
    {
        $requestBody = [
            'Entrada' => [
                'Grupo' => 0,
            ],
        ];

        return $this->client->Execute($requestBody);
    }

    public function getAsXml()
    {

        $soapEnv = [
            'soapenv:Header' => '',
            'soapenv:Body' => [
                "wsbcumonedas.Execute" => [
                    'Entrada' => [
                        'Grupo' => 0,
                    ]
                ],
            ],
        ];

        $request = ArrayToXml::convert($soapEnv, $this->envelopeHeader(), true, 'UTF-8', '1.0', ['formatOutput' => true]);

        return $this->client->__doRequest($request, self::BCU_LOCATION, self::BCU_ACTION, '1.0');
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