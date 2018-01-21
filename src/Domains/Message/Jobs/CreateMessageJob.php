<?php
namespace App\Domains\Message\Jobs;

use Lucid\Foundation\Job;

use App\Data\Contracts\MessageRepositoryInterface;

class CreateMessageJob extends Job
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
    public function handle(MessageRepositoryInterface $message)
    {
        return $message->create($this->data);
    }
}
