<?php
namespace App\Domains\Http\Jobs;

use Lucid\Foundation\Job;
use Illuminate\Http\Request;

use Redirect;

class SendToLocationJob extends Job
{
    protected $location;
    protected $message;
    protected $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($location, $message = false, $type = "info")
    {
        $this->location = $location;
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        if ($this->message) {
          $request->session()->flash('status', json_encode([
            'message' => $this->message,
            'type' => $this->type
          ]));
        }

        return Redirect::to($this->location);
    }
}
