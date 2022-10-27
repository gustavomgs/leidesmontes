<?php

namespace App\Services\LeiDesmontes;

use App\Models\Produto;
use App\Models\VeiculosSisdel;
use Exception;

class LeiDesmontesBuilders extends LeiDesmontesFormatters
{
    use LeiDesmontesSeeders;

    /**
     * @param VeiculosSisdel $veiculosSisdel
     * @return LeiDesmontesVeiculo
     */
    public function buildVeiculo(VeiculosSisdel $veiculosSisdel): LeiDesmontesVeiculo
    {
        $veiculo = new LeiDesmontesVeiculo($veiculosSisdel);

        /**
         * anexosDTO
         */
        $veiculo->certidaoBaixa          = $this->anexoFotoCertidaoBaixa($veiculosSisdel);
        $veiculo->chassi                 = $this->anexoFotoChassi($veiculosSisdel);
        $veiculo->chassiDescaracterizado = $this->anexoFotoChassiDescaracterizado($veiculosSisdel);
        $veiculo->ladoDireito            = $this->anexoFotoLadoDireito($veiculosSisdel);
        $veiculo->motor                  = $this->anexoFotoMotor($veiculosSisdel);
        $veiculo->notaFiscalEntrada      = $this->anexoNotaFiscalEntrada($veiculosSisdel);
        $veiculo->notaVenda              = $this->anexoNotaVenda($veiculosSisdel);

        /**
         * noCartela
         */
        $veiculo->noCartela = $veiculosSisdel->num_cartela;

        /**
         * notaFiscalVeiculoDTO
         */
        $veiculo->dataNotaFiscalEntrada = $this->dataFormatada($veiculosSisdel->temNfeEntrada->created_at);
        $veiculo->dataNotaVenda         = $veiculosSisdel->data_emissao;
        $veiculo->noNotaFiscalEntrada   = $veiculosSisdel->temNfeEntrada->chave;
        $veiculo->noNotaVenda           = $veiculosSisdel->num_nf;
        $veiculo->xmlNotaFiscalEntrada  = null;
        $veiculo->xmlNotaVenda          = null;

        /**
         * tipoEntrada
         */
        $veiculo->tipoEntrada = $veiculosSisdel->tipo_operacao;

        /**
         * veiculoDTO
         */
        $veiculo->noChassis = $veiculosSisdel->num_chassi  ?? null;
        $veiculo->noMotor   = $veiculosSisdel->num_motor   ?? null;
        $veiculo->noPlaca   = $veiculosSisdel->placa;
        $veiculo->noRenavam = $veiculosSisdel->num_renavam ?? null;

        /**
         * vendedorDTO
         */
        $veiculo->bairro                 = !$veiculo->vendedor ? null : $veiculo->vendedor->bairro;
        $veiculo->celular                = !$veiculo->vendedor ? null : $veiculo->vendedor->telefone;
        $veiculo->cep                    = !$veiculo->vendedor ? null : $veiculo->vendedor->cep;
        $veiculo->cidadeEndereco         = !$veiculo->vendedor ? null : $veiculo->vendedor->municipio;
        $veiculo->complementoEndereco    = !$veiculo->vendedor ? null : $veiculo->vendedor->complemento;
        $veiculo->dddCelular             = 0;
        $veiculo->dddTelefone            = 0;
        $veiculo->email                  = !$veiculo->vendedor ? null : $veiculo->vendedor->email;
        $veiculo->endereco               = !$veiculo->vendedor ? null : $veiculo->vendedor->rua;
        $veiculo->idDocumentoIdentidade  = !$veiculo->vendedor ? null : $veiculo->vendedor->ir_rg;
        $veiculo->nomePessoa             = !$veiculo->vendedor ? null : $veiculo->vendedor->razao_social;
        $veiculo->numeroDocumento        = !$veiculo->vendedor ? null : $veiculo->vendedor->cpf_cnpj;
        $veiculo->numeroEndereco         = !$veiculo->vendedor ? null : $veiculo->vendedor->numero;
        $veiculo->telefone               = !$veiculo->vendedor ? null : $veiculo->vendedor->telefone;

        return $veiculo;
    }

    /**
     * @param Produto $peca
     * @return LeiDesmontesPeca
     * @throws Exception
     */
    public function buildPeca(Produto $peca): LeiDesmontesPeca
    {
        $pecaObj = new LeiDesmontesPeca($peca);

        $pecaObj->codigoPeca = $peca->codigo;
        $pecaObj->idEstado   = $peca->codigo;
        $pecaObj->isAvulsa   = $this->isAvulsa($peca);
        $pecaObj->nEtiqueta  = $peca->etiquetaFormatada();

        return $pecaObj;
    }

    /**
     * @param VeiculosSisdel $veiculosSisdel
     * @return LeiDesmontesLaudo
     * @throws Exception
     */
    public function buildLaudo(VeiculosSisdel $veiculosSisdel): LeiDesmontesLaudo
    {
        $laudo = new LeiDesmontesLaudo();

        /**
         * informacaoLaudoDTO
         */
         $laudo->dataFinal    = null;
         $laudo->idTipoLaudo  = 0;
         $laudo->laudoTecnico = null;

        /**
         * informacaoPecasVDTO
         */
        $laudo->pecas = $this->seedPecas($veiculosSisdel);

        /**
         * veiculoDTO
         */
        $laudo->noChassis  = $veiculosSisdel->num_chassi  ?? null;
        $laudo->noMotor    = $veiculosSisdel->num_motor   ?? null;
        $laudo->noPlaca    = $veiculosSisdel->placa;
        $laudo->noRenavam  = $veiculosSisdel->num_renavam ?? null;

        return $laudo;
    }
}
