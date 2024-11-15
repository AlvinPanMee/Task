<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $this->validate($request, [
            'title'         => 'required|string',
            'description'   => 'sometimes|string'
        ]);

        $new_task = Task::updateOrCreate([
            'task_id'       => bin2hex(random_bytes(10)),
            'title'         => $request->title,
            'description'   => $request->description
        ]);

        return $new_task 
            ? api_success(['task_id' => $new_task->task_id], "Task created successfully")
            : api_error("Task failed to create");
    }

    public function view(Request $request, $task_id = '')
    {
        if ($task_id && !Task::where('task_id', $task_id)->first()) return api_error('Invalid Task Id');

        $this->validate($request,[
            'status'    => 'sometimes|int|in:1,0'
        ]);

        $tasks = Task::when($task_id, function ($query, $task_id) {
            $query->where('task_id', $task_id);
        })
        ->when($request->has('status'), function ($query) use ($request) {
            $query->where('status', $request->status);
        })
        ->get();

        return api_success($tasks);
    }

    public function update(Request $request, $task_id)
    {
        if (!$task_id) return api_error('Task Id is required');
        
        $task = Task::where('task_id', $task_id)->first();
        if (!$task) return api_error('Invalid Task Id');

        $this->validate($request, [
            'title'         => 'required|string',
            'description'   => 'sometimes|string',
            'status'        => 'sometimes|int|in:1,0',
        ]);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();

        return api_success('update completed');
    }

    public function delete($task_id)
    {
        if (!$task_id) return api_error('Task Id is required');
        
        $task = Task::where('task_id', $task_id)->first();
        if (!$task) return api_error('Invalid Task Id');

        $task->delete();

        return api_success('Task has been deleted');
    }

    public function complete($task_id)
    {
        if (!$task_id) return api_error('Task Id is required');
        
        $task = Task::where('task_id', $task_id)->first();
        if (!$task) return api_error('Invalid Task Id');

        $task->status = 0;
        $task->save();

        return api_success('Task has been updated to complete');
    }
}