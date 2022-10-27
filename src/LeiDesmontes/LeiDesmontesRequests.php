<?php

namespace App\Services\LeiDesmontes;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class LeiDesmontesRequests
{
    /**
     * @param string $request
     * @param array $body
     * @return string
     * @throws GuzzleException
     */
    public function request(string $request, array $body): string
    {
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json; charset=utf-',
                'Username' => 'hRyotiEFqNvFv4QIBleaEXDVxZ/O8bYiL9V21IGLJs6jMp/Rl+GIVzHJ0XfcRVLPzbq+VkgTyRDsOgK+B26TtWRfUjoWYAcl7dzrZ+6YZPfpbdQ5Pyz7hhEkI/WL1uiYvKzOUgb3i+TG0s5BtcRzZtkec86BSmkYgDcFp8A0Z4E=',
                'Password' => 'FtbRI+mPsMWE04jY2Z48DXIT0fGemzDkpYl9wxNGkmg22lxEMYsVTfH6warhjBiofuagHAuLqrO4LZJYR/aFdB/YhXdSq9QbHnB48WUH/5i3XeTKxSg5kYLRXX/E5qgmDfscOO0u6t3mXQPs78Y3IC8pnR+ua6q59gk3tstx5IY='
            ]
        ]);

        $response = $client->post(sprintf('%s%s', LeiDesmontesStatements::BASE_URI, $request), [
            'body' => json_encode($body)
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * @param $nEtiqueta
     * @return string
     * @throws GuzzleException
     */
    public static function verificarVeiculo($nEtiqueta): string
    {
        $dados = [
            'verificarPeca' => [
                'arg0' => [
                    'nEtiqueta' => 1
                ]
            ]
        ];

        return (new LeiDesmontesRequests)->request(LeiDesmontesStatements::VERIFICAR_PECA, $dados);
    }
}
