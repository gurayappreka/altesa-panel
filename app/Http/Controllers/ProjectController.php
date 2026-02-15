<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Customer;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('customer')->orderBy('created_at', 'desc')->paginate(12);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        return view('projects.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'customer_id' => 'nullable|exists:customers,id',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $validated['status'] = 'planning';

        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Proje oluşturuldu.');
    }

    public function show(Project $project)
    {
        $project->load('customer', 'tasks');
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $customers = Customer::orderBy('name')->get();
        return view('projects.edit', compact('project', 'customers'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'customer_id' => 'nullable|exists:customers,id',
            'status' => 'required|in:planning,active,on_hold,completed,cancelled',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Proje güncellendi.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proje silindi.');
    }
}
