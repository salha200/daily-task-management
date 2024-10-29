<?php

namespace App\Jobs;

use App\Mail\PendingTasks;
use App\Models\User;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTaskNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    protected $tasks;

    /**
     * Create a new job instance.
     */
    public function __construct($userId, $tasks)
    {
        $this->userId = $userId;
        $this->tasks = $tasks;
    }

    /**
     * Execute the job.
     * The method retrieves the user from the database
     * The method uses the Mail facade to send an email to the user’s email address, passing the list of pending tasks using the PendingTasks
     * @throws Exception
     */
    public function handle(): void
    {
        $user = User::find($this->userId);

        if ($user) {
            Mail::to($user->email)->send(new PendingTasks($this->tasks));
        } else {
            //Log::error("User with ID {$this->userId} not found.");
        }
    }
}
