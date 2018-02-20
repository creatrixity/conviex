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

    /*
     * Every conversation has messages.
     *
     * @return Eloquent Object
     */
    public function messages()
    {
        return $this->hasMany('Framework\Message');
    }

    /*
     * Return the last message of a conversation.
     *
     * @return Eloquent Object
     */
    public function getLastMessage()
    {
        return $this->messages()->latest()->first();
    }

    /**
     * Returns array of unread messages in conversation for given converser.
     *
     * @param $userId
     *
     * @return \Illuminate\Support\Collection
     */
    public function userUnreadMessages($userId)
    {
        $messages = $this->messages()->get();

        try
        {
            $converser = $this->getConverserFromUser($userId);
        } catch (ModelNotFoundException $e)
        {
            return collect();
        }

        if (!$converser->last_read_at)
        {
            return $messages;
        }

        return $messages->filter(function ($message) use ($converser){
            return $message->updated_at->gt($converser->last_read_at);
        });
    }

    /**
     * Finds the converser record from a user id.
     *
     * @param $userId
     *
     * @return mixed
     *
     * @throws ModelNotFoundException
     */
    public function getConverserFromUser($userId)
    {
        return $this->conversers()->where('user_id', $userId)->firstOrFail();
    }

    /**
     * Returns count of unread messages in conversation for a given user.
     *
     * @param $userId
     *
     * @return int
     */
    public function userUnreadMessagesCount($userId)
    {
        return $this->userUnreadMessages($userId)->count();
    }

    /**
     * See if the current conversation is unread by the user.
     *
     * @param int $userId
     *
     * @return bool
     */
    public function isUnread($userId)
    {
        try {
            $converser = $this->getConverserFromUser($userId);

            if ($converser->last_read_at === null || $this->updated_at->gt($converser->last_read_at)) {
                return true;
            }
        } catch (ModelNotFoundException $e) { // @codeCoverageIgnore
            // do nothing
        }

        return false;
    }

    /*
     * Return the last message of a conversation.
     *
     * @return Eloquent Object
     */
    public function getLastMessageHash()
    {
        if (!count($this->getLastMessage())) return;

        return '#message-'.$this->getLastMessage()->id;
    }

    /*
     * Return the last message of a conversation.
     *
     * @return Eloquent Object
     */
    public function getOtherConverser($userID)
    {
        return collect($this->conversers->all())->reject(function ($converser) use ($userID) {
            return $converser->user_id == $userID;
        })->first()->user;
    }

    public function getTimeDiff()
    {
        $createdAt = $this->created_at;

        if ($createdAt->diffInSeconds() < 60) return $createdAt->diffInSeconds(). 's';

        if ($createdAt->diffInMinutes() < 60) return $createdAt->diffInMinutes(). 'm';

        if ($createdAt->diffInHours() < 24) return $createdAt->diffInHours(). 'h';

        return $createdAt->format('jS M Y');

    }

}
