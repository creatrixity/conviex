<?php
namespace App\Domains\Conversation\Jobs;

use Lucid\Foundation\Job;

use App\Data\Contracts\ConversationRepositoryInterface;

class RetrieveConversationJob extends Job
{
    protected $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ConversationRepositoryInterface $conversation)
    {
        return $conversation->find($this->id);
    }
}
