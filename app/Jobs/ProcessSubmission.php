<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Submission;
use App\Events\SubmissionSaved;

class ProcessSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    
    public function __construct($data)
    {
        $this -> data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // save the data to the db
        $submission = Submission::create($this -> data);
        //submission event
        event(new SubmissionSaved($submission));
    }
}
