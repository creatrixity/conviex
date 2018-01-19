<?php
namespace App\Domains\Conversation\Jobs;

use Lucid\Foundation\Job;

use App\Data\Contracts\ConverserRepositoryInterface;

class CreateConverserJob extends Job
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
    public function handle(ConverserRepositoryInterface $converser)
    {
        return $converser->createIfNotExists($this->data);
    }
}
