<?php

namespace App;

use App\Notifications\meuResetDeSenha;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'tipoUser','ativo'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new meuResetDeSenha($token));
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }

    public function escola()
    {
        return $this->hasOne(Escola::class);
    }

    public function avaliador()
    {
        return $this->hasOne(Avaliador::class);
    }

    public function professor()
    {
        return $this->hasOne(Professor::class);
    }

    public function accesses()
    {
        return $this->hasMany(Access::class);
    }

    public function registerAccess()
    {
        return $this->accesses()->create([
            'user_id' => $this->id,
            'datetime' => date('YmdHis'),
        ]);
    }

}