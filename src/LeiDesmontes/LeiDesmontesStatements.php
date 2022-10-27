<?php

namespace App\Services\LeiDesmontes;

class LeiDesmontesStatements
{
    public const BASE_URI                   = 'http://api.prodataaweb.com.br/v1';

    public const resgistrarEntradaVeiculo   = 'registrarEntradaVeiculoWS';
    public const registrarLaudoTecnico      = 'registrarLaudoTecnicoWS';
    public const registrarEntradaPecaLegado = 'registrarEntradaPecaLegadoWS';

    public const verificarVeiculo           = 'verificarVeiculo';
    public const associarEtiqueta           = 'associarEtiqueta';
    public const associarCartela            = 'associarCartela';

    public const registrarMovimentoPecas    = 'registrarMovimentoPecasWS';
}
