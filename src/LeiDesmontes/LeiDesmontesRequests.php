<?php

namespace App\Services\LeiDesmontes;

use App\Models\VeiculosSisdel;
use App\Models\Venda;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class LeiDesmontesRequests extends LeiDesmontesFormatters
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
     * @param VeiculosSisdel $veiculosSisdel
     * @return string
     * @throws GuzzleException
     */
    public static function registrarEntradaVeiculo(VeiculosSisdel $veiculosSisdel): string
    {
        $veiculo = (new LeiDesmontesBuilders)->buildVeiculo($veiculosSisdel);

        $dados = [
            'registrarEntradaVeiculoWS' => [
                'arg0' => [
                    'anexosDTO' => [
                        'certidaoBaixa'          => $veiculo->certidaoBaixa,
                        'chassi'                 => $veiculo->chassi,
                        'chassiDescaracterizado' => $veiculo->chassiDescaracterizado,
                        'ladoDireito'            => $veiculo->ladoDireito,
                        'ladoEsquerdo'           => $veiculo->ladoEsquerdo,
                        'motor'                  => $veiculo->motor,
                        'notaFiscalEntrada'      => $veiculo->notaFiscalEntrada,
                        'notaVenda'              => $veiculo->notaVenda,
                    ],
                    'noCartela' => $veiculo->noCartela,
                    'notaFiscalVeiculoDTO' => [
                        'dataNotaFiscalEntrada' => $veiculo->dataNotaFiscalEntrada,
                        'dataNotaVenda'         => $veiculo->dataNotaVenda,
                        'noNotaFiscalEntrada'   => $veiculo->noNotaFiscalEntrada,
                        'noNotaVenda'           => $veiculo->noNotaVenda,
                        'xmlNotaFiscalEntrada'  => $veiculo->xmlNotaFiscalEntrada,
                        'xmlNotaVenda'          => $veiculo->xmlNotaVenda,
                    ],
                    'tipoEntrada' => $veiculo->tipoEntrada,
                    'veiculoDTO' => [
                        'noChassis' => $veiculo->noChassis,
                        'noMotor'   => $veiculo->noMotor,
                        'noPlaca'   => $veiculo->noPlaca,
                        'noRenavam' => $veiculo->noRenavam,
                    ],
                    'vendedorDTO' => [
                        'bairro'                => $veiculo->bairro,
                        'celular'               => $veiculo->celular,
                        'cep'                   => $veiculo->cep,
                        'cidadeEndereco'        => $veiculo->cidadeEndereco,
                        'complementoEndereco'   => $veiculo->complementoEndereco,
                        'dddCelular'            => 0,
                        'dddTelefone'           => 0,
                        'email'                 => $veiculo->email,
                        'endereco'              => $veiculo->endereco,
                        'idDocumentoIdentidade' => $veiculo->idDocumentoIdentidade,
                        'nomePessoa'            => $veiculo->nomePessoa,
                        'numeroDocumento'       => $veiculo->numeroDocumento,
                        'numeroEndereco'        => $veiculo->numeroEndereco,
                        'telefone'              => $veiculo->telefone,
                    ],
                ],
            ],
        ];

        return (new LeiDesmontesRequests)->request(LeiDesmontesStatements::REGISTRAR_ENTRADA_VEICULO, $dados);
    }

    /**
     * @param VeiculosSisdel $veiculosSisdel
     * @param int $tipo
     * @return string
     * @throws GuzzleException
     * @throws Exception
     */
    public static function registrarLaudoTecnico(VeiculosSisdel $veiculosSisdel, int $tipo_laudo): string
    {
        $laudo   = (new LeiDesmontesBuilders)->buildLaudo($veiculosSisdel);
        $veiculo = (new LeiDesmontesBuilders)->buildVeiculo($veiculosSisdel);

        $laudo->idTipoLaudo = $tipo_laudo;

        $dados = [
            'registrarLaudoTecnicoWS' => [
                'arg0' => [
                    'informacaoIdentificacaoDTO' => [
                        'idDocumentoIdentidade' => $veiculo->idDocumentoIdentidade,
                        'numeroDocumento'       => $veiculo->numeroDocumento,
                    ],
                    'informacaoLaudoDTO' => [
                        'dataFinal'     => $laudo->dataFinal,
                        'idTipoLaudo'   => $laudo->idTipoLaudo,
                        'laudoTecnico'  => $laudo->laudoTecnico,
                    ],
                    'informacaoPecasVDTO' => $laudo->pecas,
                    'veiculoDTO' => [
                        'noChassis' => $veiculo->noChassis,
                        'noMotor'   => $veiculo->noMotor,
                        'noPlaca'   => $veiculo->noPlaca,
                        'noRenavam' => $veiculo->noRenavam,
                    ],
                ],
            ],
        ];

        return (new LeiDesmontesRequests)->request(LeiDesmontesStatements::REGISTRAR_LAUDO_TECNICO, $dados);
    }

    /**
     * @param VeiculosSisdel $veiculosSisdel
     * @param Collection $pecas
     * @param int $tipo_laudo
     * @return string
     * @throws GuzzleException
     */
    public static function registrarEntradaPecaLegado(VeiculosSisdel $veiculosSisdel, Collection $pecas, int $tipo_laudo): string
    {
        $laudo   = (new LeiDesmontesBuilders)->buildLaudo($veiculosSisdel);
        $veiculo = (new LeiDesmontesBuilders)->buildVeiculo($veiculosSisdel);

        $laudo->idTipoLaudo = $tipo_laudo;

        $informacaoPecas = [];

        foreach ($pecas as $peca){
            $pecaObj = (new LeiDesmontesBuilders)->buildPeca($peca);

            $informacaoPecas[] = [
                'codigoPeca' => $pecaObj->codigoPeca,
                'idEstado'   => $pecaObj->idEstado,
                'isAvulsa'   => $pecaObj->isAvulsa,
                'isExtra'    => $pecaObj->isExtra,
                'nEtiqueta'  => $pecaObj->nEtiqueta,
            ];
        }

        $dados = [
            'registrarEntradaPecaLegadoWS' => [
                'arg0' => [
                    'idDocumentoIdentidade' => $veiculo->idDocumentoIdentidade,
                    'idTipoLaudo'           => $laudo->idTipoLaudo,
                    'informacaoPecasVDTO'   => $informacaoPecas,
                    'isDadosVeiculo'        => $veiculo->isDadosVeiculo,
                    'marca'                 => 0,
                    'modelo'                => 0,
                    'noCartela'             => $veiculo->noCartela,
                    'notaFiscalLegadoDTO'   => [
                        'dataNotaFiscalEntrada' => $veiculo->notaFiscalEntrada,
                        'dataNotaLeilaoCompra'  => $veiculo->dataNotaVenda,
                        'noNotaFiscalEntrada'   => $veiculo->notaFiscalEntrada,
                        'noNotaLeilaoCompra'    => null,
                    ],
                    'numeroDocumento' => 'string',
                    'tipoEntrada' => $veiculo->tipoEntrada,
                    'tipoVeiculo' => $veiculo->tipo_veiculo,
                    'veiculoDTO'  => [
                        'noChassis' => $veiculo->noChassis,
                        'noMotor'   => $veiculo->noMotor,
                        'noPlaca'   => $veiculo->noPlaca,
                        'noRenavam' => $veiculo->noRenavam,
                    ],
                ],
            ],
        ];

        return (new LeiDesmontesRequests)->request(LeiDesmontesStatements::REGISTRAR_ENTRADA_PECA_LEGADO, $dados);
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public static function registrarDevolucaoPeca(Venda $venda, array $etiquetas, int $tipoOperacao): string
    {
        $dados = [
            'registrarDevolucaoPecas' => [
                'arg0' => [
                    'dataRegistroVenda' => (new LeiDesmontesRequests)->dataFormatada($venda->created_at),
                    'listEtiquetas'     => $etiquetas,
                    'nNotaFiscal'       => $venda->chave,
                    'tipoOperacao'      => $tipoOperacao,
                ],
            ],
        ];

        return (new LeiDesmontesRequests)->request(LeiDesmontesStatements::REGISTRAR_DEVOLUCAO_PECAS, $dados);
    }

    /**
     * @param VeiculosSisdel $veiculosSisdel
     * @param Venda $venda
     * @param array $etiquetas
     * @param int $tipoOperacao
     * @return string
     * @throws GuzzleException
     * @throws Exception
     */
    public static function registrarMovimentacaoPecas(VeiculosSisdel $veiculosSisdel, Venda $venda, array $etiquetas, int $tipoOperacao): string
    {
        $laudo   = (new LeiDesmontesBuilders)->buildLaudo($veiculosSisdel);
        $veiculo = (new LeiDesmontesBuilders)->buildVeiculo($veiculosSisdel);

        $dados = [
            'registrarMovimentoPecasWS' => [
                'arg0' => [
                    'informacaoDestinatarioDTO' => [
                        'idDocumentoIdentidade' => null,
                        'nomePessoa'            => null,
                        'numeroDocumento'       => null,
                    ],
                    'informacaoEnderecoWSDTO' => [
                        'bairro'                => 'string',
                        'cep'                   => 'string',
                        'codigoCidade'          => 'string',
                        'complementoEndereco'   => 'string',
                        'endereco'              => 'string',
                        'numeroEndereco'        => 'string',
                    ],
                    'informacaoMovimentoPecasDTO' => [
                        'dataRegistro'    => 'string',
                        'idTipoDestino'   => 0,
                        'idTipoMovimento' => 0,
                        'nNotaFiscal'     => 'string',
                        'notaFiscal'      => 'string',
                        'xmlNotaFiscal'   => 'string',
                    ],
                    'listInformacaoPecasDTO' => [
                        0 => [
                            'garantia'  => 0,
                            'nEtiqueta' => 'string',
                            'preco'     => 'string',
                        ],
                    ],
                ],
            ],
        ];

        return (new LeiDesmontesRequests)->request(LeiDesmontesStatements::REGISTRAR_MOVIMENTACAO_PECAS, $dados);
    }

    /**
     * @param $nEtiqueta
     * @return string
     * @throws GuzzleException
     */
    public static function verificarPeca($nEtiqueta): string
    {
        $dados = [
            'verificarPeca' => [
                'arg0' => [
                    'nEtiqueta' => $nEtiqueta
                ]
            ]
        ];

        return (new LeiDesmontesRequests)->request(LeiDesmontesStatements::VERIFICAR_PECA, $dados);
    }

    /**
     * @param string $placa
     * @return string
     * @throws GuzzleException
     */
    public static function verificarVeiculo(string $placa): string
    {

        $dados = [
            'verificarVeiculo' => [
                'arg0' => [
                    'nroChassi' => null,
                    'nroMotor'  => null,
                    'placa'     => $placa,
                    'renavam'   => null,
                ]
            ]
        ];

        return (new LeiDesmontesRequests)->request(LeiDesmontesStatements::VERIFICAR_VEICULO, $dados);
    }

    /**
     * @param VeiculosSisdel $veiculosSisdel
     * @param string $nEtiqueta
     * @param string $nEtiquetaNova
     * @return string
     * @throws GuzzleException
     */
    public static function associarEtiqueta(VeiculosSisdel $veiculosSisdel, string $nEtiqueta, string $nEtiquetaNova): string
    {
        $veiculo = (new LeiDesmontesBuilders)->buildVeiculo($veiculosSisdel);

        $dados = [
            'associarEtiqueta' => [
                'arg0' => [
                    'nEtiqueta'     => $nEtiqueta,
                    'nEtiquetaNova' => $nEtiquetaNova,
                    'veiculoDTO' => [
                        'noChassis' => $veiculo->noChassis,
                        'noMotor'   => $veiculo->noMotor,
                        'noPlaca'   => $veiculo->noPlaca,
                        'noRenavam' => $veiculo->noRenavam,
                    ],
                ],
            ],
        ];

        return (new LeiDesmontesRequests)->request(LeiDesmontesStatements::ASSOCIAR_ETIQUETA, $dados);
    }

    /**
     * @param VeiculosSisdel $veiculosSisdel
     * @param string $nCartela
     * @param string $nEtiquetaNova
     * @return string
     * @throws GuzzleException
     */
    public static function associarCartela(VeiculosSisdel $veiculosSisdel, string $nCartela, string $nEtiquetaNova): string
    {
        $veiculo = (new LeiDesmontesBuilders)->buildVeiculo($veiculosSisdel);

        $dados = [
            'associarCartela' =>[
                'associarCartela' => [
                    'arg0' => [
                        'anexo'     => 'string',
                        'motivo'    => 'string',
                        'nCartela'  => $veiculo->noCartela,
                        'tipoOperacao' => 0,
                        'veiculoDTO' => [
                            'noChassis' => $veiculo->noChassis,
                            'noMotor'   => $veiculo->noMotor,
                            'noPlaca'   => $veiculo->noPlaca,
                            'noRenavam' => $veiculo->noRenavam,
                        ],
                    ],
                ],
            ]
        ];

        return (new LeiDesmontesRequests)->request(LeiDesmontesStatements::ASSICIAR_CARTELA, $dados);
    }

}
