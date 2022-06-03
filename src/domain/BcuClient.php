<?php

namespace cotizaciones\domain;

use SoapClient;

abstract class BcuClient
{

    public SoapClient $client;

    public function __construct()
    {
        $this->client = new SoapClient($this->getWSDL());
    }

    protected abstract function getWSDL(): string;

    protected function envelopeHeader()
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