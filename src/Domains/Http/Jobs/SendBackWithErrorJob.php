<?php
namespace App\Domains\Http\Jobs;

use Lucid\Foundation\Job;
use Redirect;

use Illuminate\Http\Request;

class SendBackWithErrorJob extends Job
{
    protected $errors;
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($errors, $data = false)
    {
        $this->errors = $errors;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
      if (count($this->data)) {
        $request->session()->flash('appStatus', json_encode([
          'message' => $this->data['message'],
          'type' => $this->data['type']
        ]));
      }

      if ($this->data['input'])
      {
          return Redirect::back()->withErrors($this->errors)->withInput($this->data['input']);
      }


      return Redirect::back()
              -> withErrors($this->errors)
              -> withInput();
    }
}
