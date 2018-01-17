<?php

namespace Framework;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{
    use SoftDeletes;

    /*
     * The attributes that are mass-assignable
     *
     * @var array
     */
    protected $fillable = ['author_id'];

    /*
     * These attributes are datetime fields.
     * They can be accessed as Carbon instances
     *
     * @var array
     */
    protected $dates = ['created_at'];

    /*
     * Every conversation has conversers.
     *
     * @return Eloquent Object
     */
    public function conversers()
    {
        return $this->belongsToMany('Framework\Converser');
    }

    /*
     * Tracks the initiator of a conversation.
     *
     * @return Eloquent Object
     */
    public function author()
    {
        return $this->belongsTo('Framework\User', 'author_id');
    }

}
