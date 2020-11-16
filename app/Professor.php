<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Professor extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = "professores";

    protected $fillable = [
        'name',
        'nascimento',
        'sexo',
        'telefone',
        'grauDeInstrucao',
        'cpf',
        'matricula',
        'tipo',
        'camisa',
        'user_id',
        'nCertificadosGeradosOrientador',
        'nCertificadosGeradosCoorientador',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function escola()
    {
        return $this->belongsToMany(Escola::class, 'escolas_professores');
    }

    public function projeto()
    {
        return $this->belongsToMany(Projeto::class, 'professores_projetos')->withPivot('tipo', 'ano');
    }

}
