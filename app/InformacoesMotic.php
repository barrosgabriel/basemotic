<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class InformacoesMotic extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $fillable = [
        'edicao',
        'data_inicio',
        'data_fim',
        'secretario',
        'assinatura_secretario',
        'prefeito',
        'assinatura_prefeito',
    ];
}
