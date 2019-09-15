<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function createTask(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $task = new Task();

        $task->name = $request->input('name');
        $task->description = $request->input('description');

        $task->save();

        return response()->json(null,200);
    }

    public function fetch()
    {
        return Task::all()->where('processed', false);
    }

    public function delete(Request $request)
    {
        Task::destroy($request->input('taskId'));

        return response()->json(null,200);
    }
}
