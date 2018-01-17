<?php
namespace App\Services\Web\Features;

use Auth;

use Lucid\Foundation\Feature;
use Illuminate\Http\Request;

use App\Domains\Conversation\Jobs\GetAllConversationsByUserJob;
use App\Domains\Conversation\Jobs\FindConversationInConversersJob;
use App\Domains\Conversation\Jobs\CreateConversationJob;
use App\Domains\Conversation\Jobs\CreateConverserJob;

use App\Domains\Http\Jobs\SendToLocationJob;

class MessageFeature extends Feature
{
    protected $id;

    public function __construct($id)
    {
        $this->id = (int) $id;
    }

    public function handle(Request $request)
    {
        # We need to search for the right conversation. We initialize $conversation to null.
        $conversation = null;

        $user = Auth::user();

        $userID = $user->id;

        # This is the new participant in our conversations.
        $participantID = $this->id;

        # If our user has been involved in any conversations.
        if ($user->conversers && count($user->conversers))
        {
            # We retrieve every conversation our user has been involved in.

            $userConversations = $this->run(GetAllConversationsByUserJob::class, [
                'user' => $user
            ]);

            foreach ($userConversations as $userConversation)
            {
                $conversers = $userConversation->conversers;

                if ($this->run(FindConversationInConversersJob::class, [
                    'conversers' => $conversers,
                    'converserID' => $participantID
                ]))
                {
                    $conversation = $userConversation;
                }
            }

        }

        if (!(count($user->converser) && !count($user->converser->conversations)) && !$conversation)
        {


            # Our user has no conversations. We create a conversation for the user.
            $conversation = $this->run(CreateConversationJob::class, [
                'data' => [
                    'author_id' => $userID
                ]
            ]);

            # Did our new conversation get created successfully?
            if (count($conversation))
            {
                $conversationID = $conversation->id;

                # We create a new converser instance for our user;
                $userConverser = $this->run(CreateConverserJob::class, [
                    'data' => [
                        'user_id' => $userID,
                        'conversation_id' => $conversation->id
                    ]
                ]);

                # We create a new converser instance for our user;
                $participantConverser = $this->run(CreateConverserJob::class, [
                    'data' => [
                        'user_id' => $participantID,
                        'conversation_id' => $conversation->id
                    ]
                ]);

                # We associate both conversers with the conversation
                $userConverser->conversations()->attach($conversation);

                $participantConverser->conversations()->attach($conversation);

                $conversation->save();

            }

        }

        $lastMessageID = null;

        if(count($conversation) && count($conversation->messages))
        {
            $lastMessageID = collect($conversation->messages)->pop()->id;
        }

        $redirectLocation = $lastMessageID ? "/conversations/$conversation->id#message-$lastMessageID"
                                            : "/conversations/$conversation->id";

        return $this->run(SendToLocationJob::class, [
            'location' => $redirectLocation
        ]);

    }
}
