<?php

namespace App\Console\Commands;
use App\Jobs\SendTaskNotificationJob;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;

class SendPendingTasksEmail extends Command
{
    protected $signature = 'tasks:send-pending-emails';
    protected $description = 'Send daily emails to users with their pending tasks for today';
    /**
     * fetch all user
     * retrive pending task
     * If there are pending tasks, a job is dispatched to send a notification.
     * @return void
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $pendingTasks = Task::where('user_id', $user->id)
                ->where('status', 'Pending')
                ->get()->toArray();
            if (!empty($pendingTasks)) {
                SendTaskNotificationJob::dispatch($user->id, $pendingTasks);            }
        }

        $this->info('Emails sent successfully!');
    }
}
