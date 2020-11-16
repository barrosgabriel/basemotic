<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inscricaoAvaliadores extends Model
{
    protected $fillable =[
        'data_inicio', 'data_fim',
    ];
}
