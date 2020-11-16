<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvisosMotic extends Model
{
    protected $fillable = [
        'titulo', 'corpo_aviso', 'ativo'
    ];
}
