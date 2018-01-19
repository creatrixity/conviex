<?php
namespace App\Domains\Conversation\Jobs;

use Lucid\Foundation\Job;

use App\Data\Contracts\ConversationRepositoryInterface;

class CreateConversationJob extends Job
{
    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ConversationRepositoryInterface $conversation)
    {
        return $conversation->create($this->data);
    }
}
