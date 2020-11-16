<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Conteudo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
            'contato', 'sobre',
        ];

}
