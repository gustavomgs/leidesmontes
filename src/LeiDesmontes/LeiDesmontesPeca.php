<?php

namespace App\Services\LeiDesmontes;

use App\Models\Produto;
use Exception;

class LeiDesmontesPeca
{
    /**
     * @var Produto
     */
    private Produto $peca;

    /**
     * @var string
     */
    public string $codigoPeca;
    /**
     * @var int
     */
    public int $idEstado;
    /**
     * @var string
     */
    public string $isAvulsa;
    /**
     * @var string
     */
    public string $isExtra;
    /**
     * @var string
     */
    public string $nEtiqueta;

    /**
     * @throws Exception
     */
    public function __construct(Produto $peca)
    {
        $this->peca = $peca;
        $this->setCodigoPeca();
        $this->setIsAvulsa();
        $this->setIdEstado();
        $this->setIsExtra();
        $this->setNEtiqueta();
    }

    /**
     * @return void
     */
    private function setCodigoPeca(): void
    {
        $this->codigoPeca = $this->peca->codigo;
    }

    /**
     * @return void
     * @throws Exception
     */
    private function setIdEstado(): void
    {
        if(in_array($this->peca->estado, [5,4,3,2])){
            throw new Exception('[LeiDesmontePeca] Código de estado inválido. Ref. 001');
        }
        $this->idEstado = $this->peca->estado;
    }

    /**
     * @return void
     */
    private function setIsAvulsa(): void
    {
        $lastCaracter = substr($this->peca->nome, -1);

        $this->isAvulsa = ($lastCaracter == 2) ? 'Y' : 'N';
    }

    /**
     * @return void
     */
    private function setIsExtra(): void
    {
        $this->isExtra = 'N';
    }

    /**
     * @return void
     */
    private function setNEtiqueta(): void
    {
        $this->nEtiqueta = $this->peca->etiquetaFormatada();
    }

}
