<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['project', 'assignee'])->orderBy('created_at', 'desc')->paginate(15);
        return view('tasks.index', compact('tasks'));
    }

    public function myTasks()
    {
        $tasks = Task::with('project')
            ->where('assigned_to', auth()->id())
            ->orderBy('due_date')
            ->get();
        return view('tasks.my-tasks', compact('tasks'));
    }
}
