<?php

namespace App\Services\LeiDesmontes;

use App\Models\Cnpj;
use App\Models\Fornecedor;
use App\Models\VeiculosSisdel;
use Illuminate\Database\Eloquent\Collection;

class LeiDesmontesVeiculo
{
    /**
     * @var VeiculosSisdel
     */
    private VeiculosSisdel $veiculosSisdel;

    /**
     * anexosDTO
     * @var string|null
     */
    public ?string $certidaoBaixa;

    /**
     * @var string|null
     */
    public ?string $chassi;

    /**
     * @var string|null
     */
    public ?string $chassiDescaracterizado;

    /**
     * @var string|null
     */
    public ?string $ladoDireito;

    /**
     * @var string|null
     */
    public ?string $ladoEsquerdo;

    /**
     * @var String
     */
    public string $motor;

    /**
     * @var String
     */
    public String $notaFiscalEntrada;

    /**
     * @var String
     */
    public String $notaVenda;

    /**
     * @var String
     */
    public String $noCartela;

    /**
     * notaFiscalVeiculoDTO
     * @var String
     */
    public string $dataNotaFiscalEntrada;

    /**
     * @var String
     */
    public string $dataNotaVenda;

    /**
     * @var String
     */
    public string $noNotaFiscalEntrada;

    /**
     * @var String
     */
    public string $noNotaVenda;

    /**
     * @var String
     */
    public string $xmlNotaFiscalEntrada;

    /**
     * @var String
     */
    public string $xmlNotaVenda;

    /**
     * @var Int
     */
    public int $tipoEntrada = 0;

    /**
     * veiculoDTO
     * @var string|null
     */
    public ?string $noChassis;

     /**
      * @var string|null
      */
    public ?string $noMotor;
     /**
      * @var String
      */
    public string $noPlaca;
     /**
      * @var string|null
      */
    public ?string $noRenavam;

     /**
      * vendedorDTO
      * @var String
      */
    public string $bairro;

    /**
     * @var String
     */
    public string $celular;

    /**
     * @var String
     */
    public string $cep;

    /**
     * @var String
     */
    public string $cidadeEndereco;

    /**
     * @var String
     */
    public string $complementoEndereco;

    /**
     * @var int
     */
    public int $dddCelular;

     /**
      * @var int
      */
    public int $dddTelefone;

     /**
      * @var String
      */
    public string $email;

     /**
      * @var String
      */
    public string $endereco;

     /**
      * @var int
      */
    public int $idDocumentoIdentidade;

     /**
      * @var String
      */
    public string $nomePessoa;

     /**
      * @var String
      */
    public string $numeroDocumento;

    /**
     * @var String
     */
    public string $numeroEndereco;

    /**
     * @var String
     */
    public string $telefone;

    /**
     * @var Collection|null
     */
    public ?Collection $vendedor;

    public function __construct(VeiculosSisdel $veiculosSisdel)
    {
        $this->veiculosSisdel = $veiculosSisdel;
        $this->setVendedor();
    }

    /**
     * @return void
     */
    private function setVendedor(): void
    {
        $this->vendedor = Fornecedor::where('cpf_cnpj', str_replace(array(".", "-", "/"), '', $this->veiculosSisdel->cpf_cnpj_comitente))->first() ?? [];
    }
}
