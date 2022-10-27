<?php

namespace App\Services\LeiDesmontes;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Collection;

class LeiDesmontesLaudo
{
    /**
     * @var string
     */
    public string $dataFinal;
    /**
     * @var int
     */
    public int $idTipoLaudo;
    /**
     * @var string
     */
    public string $laudoTecnico;

    /**
     * @var array
     */
    public array $pecas;

    /**
     * @var string|null
     */
    public ?string $noChassis;
    /**
     * @var string|null
     */
    public ?string $noMotor;
    /**
     * @var string
     */
    public string $noPlaca;
    /**
     * @var string|null
     */
    public ?string $noRenavam;
}
