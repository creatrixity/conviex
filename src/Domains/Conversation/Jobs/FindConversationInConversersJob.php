<?php
namespace App\Domains\Conversation\Jobs;

use Lucid\Foundation\Job;

class FindConversationInConversersJob extends Job
{
    protected $conversers;
    protected $converserID;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($conversers, $converserID)
    {
        $this->conversers = $conversers;
        $this->converserID = $converserID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $hasConversation = false;

        $conversers = $this->conversers;

        foreach ($this->conversers as $converser) {

                $hasConversation = $converser->user_id == $this->converserID;

                if ($hasConversation) break;

        }

        return $hasConversation;

    }

}
