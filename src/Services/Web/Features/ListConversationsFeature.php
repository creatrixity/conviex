<?php
namespace App\Services\Web\Features;

use Lucid\Foundation\Feature;
use Illuminate\Http\Request;

use Auth;

use App\Domains\Conversation\Jobs\FetchUserConversationsJob;

class ListConversationsFeature extends Feature
{
    public function handle(Request $request)
    {

        $conversations = $this->run(FetchUserConversationsJob::class, [
            'userID' => Auth::id()
        ]);

        $unreadConversations = collect($conversations)->filter(function ($conversation) {
            return $conversation->isUnread(Auth::id());
        })->count();

        $data = [
            'conversations' => $conversations,
            'unreadConversations' => $unreadConversations
        ];

        return view('app.conversation.conversation-index', [
            'data' => $data
        ]);
    }
}
