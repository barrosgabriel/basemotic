<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Chancela extends Model
{

    protected $fillable = [
        'name',
        'chancela',
        'tipo',
        'escola',
        'escola_id',
        'avaliador_id',
        'ano',
    ];


    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }

    public function avaliador()
    {
        return $this->belongsTo(Avaliador::class);
    }


}
