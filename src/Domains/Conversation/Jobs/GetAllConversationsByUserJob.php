<?php
namespace App\Domains\Conversation\Jobs;

use Lucid\Foundation\Job;

class GetAllConversationsByUserJob extends Job
{
    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $userConversations = null;

        # We retrieve all converser instances belonging to our user.
        foreach ($this->user->conversers as $currentConverser)
        {
            foreach ($currentConverser->conversations as $conversation)
            {
                $userConversations[] = $conversation;
            }

        }

        return $userConversations;
    }
}
