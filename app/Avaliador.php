<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Avaliador extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'avaliadores';

    protected $fillable = [
        'name',
        'nascimento',
        'sexo',
        'telefone',
        'grauDeInstrucao',
        'cpf',
        'instituicao',
        'projeto_id',
        'user_id',
        'nCertificadosGerados',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projeto()
    {
        return $this->belongsToMany(Projeto::class, 'avaliadores_projetos');
    }

    public function nota()
    {
        return $this->hasMany(Nota::class);
    }

}
