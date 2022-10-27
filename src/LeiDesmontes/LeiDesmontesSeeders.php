<?php

namespace App\Services\LeiDesmontes;

use App\Models\VeiculosSisdel;
use Exception;

trait LeiDesmontesSeeders
{
    /**
     * @param VeiculosSisdel $veiculosSisdel
     * @return array
     * @throws Exception
     */
    public function seedPecas(VeiculosSisdel $veiculosSisdel): array
    {
        try {
            $return = [];

            if(!$veiculosSisdel->pecasRastreaveis()) throw new Exception('[seedPecas] Este veiculo não possui peças rastreáveis. Ref. 001');
            foreach ($veiculosSisdel->pecasRastreaveis() as $peca){
                $peca = new LeiDesmontesPeca($peca);

                $return[] = [
                    "codigoPeca" => $peca->codigoPeca,
                    "idEstado"   => $peca->idEstado,
                    "isAvulsa"   => $peca->isAvulsa,
                    "isExtra"    => $peca->isExtra,
                    "nEtiqueta"  => $peca->nEtiqueta,
                ];
            }
            return $return;
        }catch (Exception $e){
            throw new Exception("[seedPecas] {$e->getMessage()}. Ref. 001");
        }

    }
}
