<?php

namespace Framework;

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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
     * Every user has multiple converser instances.
     *
     * @return Eloquent Object
     */
    public function conversers()
    {
        return $this->hasMany('Framework\Converser');
    }

    /*
     * Every user has many messages.
     *
     * @return Eloquent Object
     */
     public function messages()
     {
         return $this->hasMany('Framework\Converser');
     }

}
