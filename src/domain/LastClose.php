<?php

namespace cotizaciones\domain;

use Spatie\ArrayToXml\ArrayToXml;
use stdClass;

class LastClose extends BcuClient
{

    const BCU_LOCATION = 'https://cotizaciones.bcu.gub.uy/wscotizaciones/servlet/awsultimocierre';
    const BCU_ACTION = 'Cotizaaction/AWSULTIMOCIERRE.Execute';

    public function get(): StdClass
    {
        return $this->client->Execute();
    }

    public function getAsXml(): string
    {
        $request = [
            'soapenv:Header' => '',
            'soapenv:Body' => [
                "wsultimocierre.Execute" => [

                ],
            ],
        ];

        $xml = ArrayToXml::convert($request, $this->envelopeHeader(), true, 'UTF-8', '1.0', ['formatOutput' => true]);

        return $this->client->__doRequest($xml, self::BCU_LOCATION, self::BCU_ACTION, '1.0');
    }

    protected function getWSDL(): string
    {
        return 'https://cotizaciones.bcu.gub.uy/wscotizaciones/servlet/awsultimocierre?wsdl';
    }
}