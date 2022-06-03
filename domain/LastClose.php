<?php

class LastClose
{
    const BCU_WSDL = 'https://cotizaciones.bcu.gub.uy/wscotizaciones/servlet/awsultimocierre?wsdl';
    public SoapClient $client;

    public function __construct()
    {
        $this->client = new SoapClient(self::BCU_WSDL);
    }

    public function get()
    {
        $response = $this->client->Execute();
        print_r($response);
        die();
    }
}