<?php
namespace App\Services\Web\Features;

use Lucid\Foundation\Feature;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Validation\ValidationException;

use App\Domains\Http\Jobs\SendBackWithErrorJob;
use App\Domains\Http\Jobs\SendToLocationJob;

use App\Domains\Message\Jobs\ValidateMessageCreationJob;
use App\Domains\Message\Jobs\CreateMessageJob;


class CreateMessageFeature extends Feature
{
    public function handle(Request $request)
    {
        # We retrieve the authenticated user.
        $author = Auth::user();

        $data = $request->input();

        try
        {
            # Is the data provided by our user valid?
            $this->run(ValidateMessageCreationJob::class, [
                'data'  =>  $data
            ]);

            # We create the message and store it in the $message variable.
            $message = $this->run(CreateMessageJob::class, [
                'data'  =>  $data
            ]);

            # We run a redirect to the conversation with the id of our newly created message.
            return $this->run(SendToLocationJob::class, [
                'location' => "/conversations/$message->conversation_id#message-$message->id"
            ]);

        } catch (ValidationException $e) {

            return $this->run(SendBackWithErrorJob::class, [
                'errors' => $e->validator,
                'data' => [
                  'message' => 'You have validation errors',
                  'input' => $request->input()
                ]
            ]);

        }
    }
}
