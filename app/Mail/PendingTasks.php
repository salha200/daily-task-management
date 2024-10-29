<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PendingTasks extends Mailable
{
    use Queueable, SerializesModels;

    public $tasks;

    public function __construct($tasks)
    {
        $this->tasks = $tasks;
    }

    public function build()
    {
        return $this->view('emails.pending_tasks')
            ->subject('Your Pending Tasks for Today')
            ->with(['tasks' => $this->tasks]);
    }
}
