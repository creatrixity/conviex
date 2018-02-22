<?php

namespace Framework;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Avatar;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
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

     /*
      * Returns a user's first name.
      *
      * @return { String }
      */

     public function getFirstName()
     {
         $str = explode('.', trim($this->name));

         $name = count($str) > 1 ? $str[1] : $str[0];

         $name = explode(' ', trim($name))[0];

         return $name;
     }

     /*
      * Returns an avatar image based on a users name.
      *
      * @return { String }
      */

     public function getUserAvatar($size = 128)
     {
         $avatar = Avatar::create($this->name)->setDimension($size)->setFontSize(10)->setShape('square')->toBase64();

         return $avatar;
     }

}
