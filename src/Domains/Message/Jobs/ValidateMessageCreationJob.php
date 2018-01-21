<?php
namespace App\Domains\Message\Jobs;

use Lucid\Foundation\Job;

use App\Domains\Message\Validators\MessageCreationValidator;

class ValidateMessageCreationJob extends Job
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
    public function handle(MessageCreationValidator $validator)
    {
        return $validator->validate($this->data);
    }
}
