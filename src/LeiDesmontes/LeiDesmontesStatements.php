<?php

namespace App\Services\LeiDesmontes;

class LeiDesmontesStatements
{
    public const BASE_URI                   = 'http://api.leidosdesmontes.com.br:8290/v1/';

    public const REGISTRAR_ENTRADA_VEICULO     = 'registrarEntradaVeiculoWS';
    public const REGISTRAR_LAUDO_TECNICO       = 'registrarLaudoTecnicoWS';
    public const REGISTRAR_ENTRADA_PECA_LEGADO = 'registrarEntradaPecaLegadoWS';
    public const REGISTRAR_DEVOLUCAO_PECAS     = 'registrarDevolucaoPecas';
    public const REGISTRAR_MOVIMENTACAO_PECAS  = 'registrarMovimentoPecasWS';

    public const VERIFICAR_VEICULO          = 'verificarVeiculo';
    public const VERIFICAR_PECA             = 'verificarPeca';
    public const ASSOCIAR_ETIQUETA          = 'associarEtiqueta';
    public const ASSICIAR_CARTELA           = 'associarCartela';

    public const REGISTRAR_MOVIMENTO_PECAS  = 'registrarMovimentoPecasWS';

    public const LAUDO_TIPO_TECNICO      = 1;
    public const LAUDO_TIPO_COMPLEMENTAR = 2;

    public const DEVOLUICAO_OPERACAO_SOLICITACAO = 1;
    public const DEVOLUICAO_OPERACAO_REGISTRO    = 2;
}
