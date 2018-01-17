<?php

namespace Framework;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use SoftDeletes;

    /*
     * The attributes that are mass-assignable
     *
     * @var array
     */
    protected $fillable = ['conversation_id', 'user_id', 'body'];

    /*
     * These attributes are datetime fields.
     * They can be accessed as Carbon instances
     *
     * @var array
     */
    protected $dates = ['created_at'];

    /*
     * Attributes whose updated_at values are changed when we save().
     *
     * @var array
     */
    protected $touches = ['conversation'];

    /*
     * Every message belongs to a conversation.
     *
     * @return Eloquent Object
     */
    public function conversation()
    {
        return $this->belongsTo('Framework\Conversation');
    }

    /*
     * Every message belongs to a user.
     *
     * @return Eloquent Object
     */
    public function user()
    {
        return $this->belongsTo('Framework\User');
    }

}
