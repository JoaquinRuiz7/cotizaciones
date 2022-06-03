<?php

namespace cotizaciones\domain;

use Spatie\ArrayToXml\ArrayToXml;
use stdClass;

class Currency extends BcuClient
{
    const BCU_LOCATION = 'https://cotizaciones.bcu.gub.uy/wscotizaciones/servlet/awsbcumonedas';
    const BCU_ACTION = 'Cotizaaction/AWSBCUMONEDAS.Execute';

    public function get(): StdClass
    {
        $requestBody = [
            'Entrada' => [
                'Grupo' => 0,
            ],
        ];

        return $this->client->Execute($requestBody);
    }

    public function getAsXml(): string
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


    protected function getWSDL(): string
    {
        return 'https://cotizaciones.bcu.gub.uy/wscotizaciones/servlet/awsbcumonedas?wsdl';
    }
}