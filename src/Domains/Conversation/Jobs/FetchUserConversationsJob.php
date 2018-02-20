<?php
namespace App\Domains\Conversation\Jobs;

use Lucid\Foundation\Job;

use Framework\Converser;

class FetchUserConversationsJob extends Job
{
    protected $userID;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userID)
    {
        $this->userID = $userID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $conversations = [];

        $converserInstances = Converser::where('user_id', $this->userID)->get();

        foreach ($converserInstances as $converser) {

            foreach ($converser->conversations as $conversation)
            {
                $conversations[] = $conversation;
            }

        }

        return $conversations;
    }
}
