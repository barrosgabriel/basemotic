<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Projeto extends Model implements Auditable
{
    protected $fillable = [
        'titulo',
        'area',
        'estande',
        'resumo',
        'objetivo',
        'metodologia',
        'recurso',
        'avaliacao',
        'ano',
        'tipo',
        'avaliado',
        'tipoEscola',
        'avaliadores',
        'notaFinal',
        'votacao_popular',
        'categoria_id',
        'escola_id',
        'turno',
    ];

    use \OwenIt\Auditing\Auditable;

    public function avaliador()
    {
        return $this->belongsToMany(Avaliador::class, 'avaliadores_projetos');
    }

    public function disciplina()
    {
        return $this->belongsToMany(Disciplina::class, 'projetos_disciplinas');
    }

    public function aluno()
    {
        return $this->belongsToMany(Aluno::class, 'alunos_projetos')->withPivot('etapa_projeto');

    }

    public function professor()
    {
        return $this->belongsToMany(Professor::class, 'professores_projetos')->withPivot('tipo', 'ano');
    }

    public function nota()
    {
        return $this->hasMany(Nota::class);
    }

    public function escola()
    {
        return $this->belongsTo(Escola::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

}
