<?php
namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Exception;

class TaskService
{
    public function getUserTasks()
    {
        try {
            return Cache::remember('user_tasks_' . Auth::id(), 60, function () {
                return Task::where('user_id', Auth::id())->get();
            });
        } catch (Exception $e) {
            throw new \Exception('Could not fetch tasks: ' . $e->getMessage());
        }
    }

    public function createTask(array $data)
    {
        try {
            $task = Task::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'due_date' => $data['due_date'],
                'status' => $data['status'],
                'user_id' => Auth::id(),
            ]);

            Cache::forget('user_tasks_' . Auth::id());

            return $task;
        } catch (Exception $e) {
            throw new \Exception('Could not create task: ' . $e->getMessage());
        }
    }

    public function updateTask(Task $task, array $data)
    {
        try {
            $task->update($data);

            Cache::forget('user_tasks_' . Auth::id());

            return $task;
        } catch (Exception $e) {
            throw new \Exception('Could not update task: ' . $e->getMessage());
        }
    }

    public function deleteTask(Task $task)
    {
        try {
            $task->delete();

            Cache::forget('user_tasks_' . Auth::id());
        } catch (Exception $e) {
            throw new \Exception('Could not delete task: ' . $e->getMessage());
        }
    }
}
