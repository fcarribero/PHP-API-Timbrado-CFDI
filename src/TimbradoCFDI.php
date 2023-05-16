<?php


namespace Advans\Api\TimbradoCFDI;

use App\Bitacora;
use App\Exceptions\TimbradorException;
use App\Nusoap\NusoapClient;
use stdClass;
use Webneex\NuSoap\nusoap_client;

class TimbradoCFDI {

    protected Config $config;

    public function __construct(Config $config) {
        $this->config = $config;
    }

    public function version(): string {
        return $this->call('version');
    }

    public function timbre($cfdi) {
        $result = $this->callSoap('timbrar', [
            'credential' => $this->config->key,
            'cfdi' => $cfdi,
        ]);
        if (!in_array($result['Code'], ['200', '307'])) {
            throw new TimbradoCFDIException("{$result['Code']}: {$result['Message']}", $cfdi);
        }
        return $result['CFDI'];
    }

    public function acuse($uuid) {
        $result = $this->callSoap('consultar', [
            'credential' => $this->config->key,
            'uuid' => $uuid,
        ]);

        if ($result['Code'] == '205') {
            return null;
        }

        return $result['Acuse'];
    }

    protected function callSoap($method, $params): string {
        $client = new nusoap_client($this->config->base_url, true);
        $client->soap_defencoding = 'utf-8';
        $client->decode_utf8 = false;
        $client->timeout = 600;
        $client->response_timeout = 600;
        $result = $client->call($method, $params);
        if (($err = $client->getError())) {
            throw new TimbradoCFDIException($err);
        }
        if ($client->fault) {
            throw new TimbradoCFDIException($client->fault);
        }
        return $result;
    }
}