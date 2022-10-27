<?php

namespace App\Services\LeiDesmontes;

use App\Models\Produto;
use App\Models\VeiculosSisdel;

class LeiDesmontesFormatters
{
    /**
     * @param $data
     * @return false|string
     */
    public function dataFormatada($data){
        return date('d-m-Y', strtotime($data));
    }

    /**
     * @param VeiculosSisdel $veiculosSisdel
     * @return string|null
     */
    public function anexoFotoCertidaoBaixa(VeiculosSisdel $veiculosSisdel): ?string
    {
        if($veiculosSisdel->temCertidaoBaixa){
            return base64_encode(file_get_contents($veiculosSisdel->temCertidaoBaixa->url));
        }
        return null;
    }

    /**
     * @param VeiculosSisdel $veiculosSisdel
     * @return string|null
     */
    public function anexoFotoChassi(VeiculosSisdel $veiculosSisdel): ?string
    {
        if($veiculosSisdel->fotoChassi){
            return base64_encode(file_get_contents($veiculosSisdel->fotoChassi->url));
        }
        return null;
    }

    /**
     * @param VeiculosSisdel $veiculosSisdel
     * @return string|null
     */
    public function anexoFotoChassiDescaracterizado(VeiculosSisdel $veiculosSisdel): ?string
    {
        if($veiculosSisdel->fotoChassiDescaracterizado){
            return base64_encode(file_get_contents($veiculosSisdel->fotoChassiDescaracterizado->url));
        }
        return null;
    }

    /**
     * @param VeiculosSisdel $veiculosSisdel
     * @return string|null
     */
    public function anexoFotoLadoDireito(VeiculosSisdel $veiculosSisdel): ?string
    {
        if($veiculosSisdel->fotoLadoDireito){
            return base64_encode(file_get_contents($veiculosSisdel->fotoLadoDireito->url));
        }
        return null;
    }

    /**
     * @param VeiculosSisdel $veiculosSisdel
     * @return string|null
     */
    public function anexoFotoLadoEsquerdo(VeiculosSisdel $veiculosSisdel): ?string
    {
        if($veiculosSisdel->fotoLadoEsquerdo){
            return base64_encode(file_get_contents($veiculosSisdel->fotoLadoEsquerdo->url));
        }
        return null;
    }

    /**
     * @param VeiculosSisdel $veiculosSisdel
     * @return string|null
     */
    public function anexoFotoMotor(VeiculosSisdel $veiculosSisdel): ?string
    {
        if($veiculosSisdel->fotoMotor){
            return base64_encode(file_get_contents($veiculosSisdel->fotoMotor->url));
        }
        return null;
    }

    /**
     * @param VeiculosSisdel $veiculosSisdel
     * @return string|null
     */
    public function anexoNotaFiscalEntrada(VeiculosSisdel $veiculosSisdel): ?string
    {
        if($veiculosSisdel->temNfCompra){
            return base64_encode(file_get_contents($veiculosSisdel->temNfCompra->url));
        }
        return null;
    }

    /**
     * @param VeiculosSisdel $veiculosSisdel
     * @return string|null
     */
    public function anexoNotaVenda(VeiculosSisdel $veiculosSisdel): ?string
    {
        if($veiculosSisdel->temNfLeilao){
            return base64_encode(file_get_contents($veiculosSisdel->temNfLeilao->url));
        }
        return null;
    }

    /**
     * @param Produto $peca
     * @return string
     */
    public function isAvulsa(Produto $peca){

        $lastCaracter = substr($peca->nome, -1);

        return ($lastCaracter == 2) ? 'Y' : 'N';
    }
}
