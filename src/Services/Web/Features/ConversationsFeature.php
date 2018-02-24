<?php
namespace App\Services\Web\Features;

use Lucid\Foundation\Feature;
use Illuminate\Http\Request;

use Auth;

use App\Domains\Conversation\Jobs\RetrieveConversationJob;

class ConversationsFeature extends Feature
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(Request $request)
    {
        $userID = Auth::user()->id;

        $conversation = $this->run(RetrieveConversationJob::class, [
            'id' => $this->id
        ]);

        $messages = $conversation->messages;

        $allConversers = $conversation->conversers;

        if (count($allConversers))
        {
            $conversers = $allConversers->reject(function ($converser) use ($userID) {
                return $converser->user_id == $userID;
            });

            $currentConverser = $allConversers->reject(function ($converser) use ($userID){
                return $converser->user_id != $userID;
            })->first();

            $unreadMessages = $conversation->userUnreadMessagesCount(Auth::id());

            $data = [
                'conversation' => $conversation,
                'conversers' => $conversers,
                'currentConverser' => $currentConverser,
                'unreadMessages' => $unreadMessages,
                'messages' => $messages
            ];

            return view('app.conversation.conversation-view', [
                'data' => $data
            ]);

        }

    }
}
