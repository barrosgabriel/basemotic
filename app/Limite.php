<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Limite extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = "limites";

    protected $fillable =[
        'limite',
    ];

}
