<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Customer;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('customer')->latest()->paginate(15);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $customers = Customer::active()->get();
        return view('projects.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'customer_id' => 'nullable|exists:customers,id',
            'status' => 'required|in:planning,active,on_hold,completed,cancelled',
            'priority' => 'required|in:low,medium,high',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable',
        ]);

        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Proje başarıyla oluşturuldu.');
    }

    public function show(Project $project)
    {
        $project->load(['customer', 'tasks.assignedUser']);
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $customers = Customer::active()->get();
        return view('projects.edit', compact('project', 'customers'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'customer_id' => 'nullable|exists:customers,id',
            'status' => 'required|in:planning,active,on_hold,completed,cancelled',
            'priority' => 'required|in:low,medium,high',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Proje başarıyla güncellendi.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proje başarıyla silindi.');
    }
}
