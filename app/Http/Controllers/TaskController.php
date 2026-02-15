<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function myTasks()
    {
        $tasks = Task::with(['project'])
            ->where('assigned_to', auth()->id())
            ->orderBy('due_date')
            ->paginate(15);

        return view('tasks.my-tasks', compact('tasks'));
    }

    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|in:todo,in_progress,done',
            'assigned_to' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date',
        ]);

        $project->tasks()->create($validated);

        return redirect()->route('projects.show', $project)->with('success', 'Görev başarıyla oluşturuldu.');
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|in:todo,in_progress,done',
            'assigned_to' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()->route('projects.show', $task->project)->with('success', 'Görev başarıyla güncellendi.');
    }

    public function destroy(Task $task)
    {
        $project = $task->project;
        $task->delete();
        return redirect()->route('projects.show', $project)->with('success', 'Görev başarıyla silindi.');
    }
}
