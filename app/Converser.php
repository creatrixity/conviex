<?php

namespace Framework;

use Illuminate\Database\Eloquent\Model;

class Converser extends Model
{
    /*
     * The attributes that are mass-assignable
     *
     * @var array
     */
    protected $fillable = ['user_id', 'conversation_id', 'last_read_at'];

    /*
     * These attributes are datetime fields.
     * They can be accessed as Carbon instances
     *
     * @var array
     */
    protected $dates = ['last_read_at'];

    /*
     * Every converser instance is tied to a user.
     *
     * @return Eloquent Object
     */
    public function user()
    {
        return $this->belongsTo('Framework\User');
    }

    /*
     * Every converser instance is tied to a conversation.
     *
     * @return Eloquent Object
     */
    public function conversations()
    {
        return $this->belongsToMany('Framework\Conversation');
    }

}
