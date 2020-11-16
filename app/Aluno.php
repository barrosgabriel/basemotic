<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Aluno extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'nascimento',
        'cpf',
        'sexo',
        'email',
        'telefone',
        'etapa',
        'turma',
        'camisa',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cep',
        'cidade',
        'estado',
        'pais',
        'ultimoProjeto',
        'escola_id',
        'categoria_id',
        'nCertificadosGerados',
    ];

    public function projeto()
    {
        return $this->belongsToMany(Projeto::class, 'alunos_projetos');
    }

    public function etapa()
    {
        return $this->belongsTo(Etapa::class);
    }

    public function escola()
    {
        return $this->belongsTo(Escola::class, 'escola_id', 'id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }


}
