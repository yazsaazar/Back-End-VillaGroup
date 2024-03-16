<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Usuarios extends Model implements Authenticatable, JWTSubject
{
    use AuthenticatableTrait;
    protected $table = 'usuarios';
    protected $fillable = ['usuario', 'id_resort', 'password', 'token_jwt'];


    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function guardarToken($token)
    {
        $this->token = $token;
        $this->save();
    }

    public function resort()
    {
        return $this->belongsTo(Resorts::class, 'id_resort');
    }
}
