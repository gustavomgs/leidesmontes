<?php

namespace App\Services\LeiDesmontes;

class LeiDesmontesStatements
{
    public const BASE_URI                   = 'http://api.leidosdesmontes.com.br:8290/v1/';

    public const REGISTRAR_ENTRADA_VEICULO     = 'registrarEntradaVeiculoWS';
    public const REGISTRAR_LAUDO_TECNICO       = 'registrarLaudoTecnicoWS';
    public const REGISTRAR_ENTRADA_PECA_LEGADO = 'registrarEntradaPecaLegadoWS';

    public const VERIFICAR_VEICULO          = 'verificarVeiculo';
    public const VERIFICAR_PECA             = 'verificarPeca';
    public const ASSOCIAR_ETIQUETA          = 'associarEtiqueta';
    public const ASSICIAR_CARTELA           = 'associarCartela';

    public const REGISTRAR_MOVIMENTO_PECAS  = 'registrarMovimentoPecasWS';
}
