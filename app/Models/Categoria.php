<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Categoria extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'categoria', 'descricao',
    ];

    public function escola()
    {
        return $this->belongsToMany(Escola::class, 'escolas_categorias', 'escola_id', 'categoria_id');
    }

    public function aluno()
    {
        return $this->hasMany(Aluno::class, 'aluno_id', 'id');
    }

    public function projeto()
    {
        return $this->hasMany(Projeto::class);
    }

    public function suplente()
    {
        return $this->hasMany(Suplente::class);
    }

}
