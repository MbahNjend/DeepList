<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $query = Todo::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan view type
        switch ($request->view) {
            case 'important':
                $query->where('priority', 'high');
                break;
            case 'upcoming':
                $query->where('due_date', '>', now())
                    ->where('is_completed', false);
                break;
            case 'completed':
                $query->where('is_completed', true);
                break;
            default:
                $query->where('is_completed', false);
        }

        // Filter berdasarkan priority jika ada
        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        $todos = $query->orderBy('due_date')->paginate(10);
        $view = $request->view ?? 'all';

        return view('todos.index', compact('todos', 'view'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high'
        ]);

        Todo::create($validated);

        return redirect()->back()->with('success', 'Task created successfully!');
    }

    public function toggle(Todo $todo)
    {
        $todo->update([
            'is_completed' => true
        ]);

        return redirect()->back()->with('success', 'Task completed!');
    }

    public function edit(Todo $todo)
    {
        return response()->json($todo);
    }

    public function update(Request $request, Todo $todo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high'
        ]);

        $todo->update($validated);

        return redirect()->back()->with('success', 'Task updated successfully!');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->back()->with('success', 'Task deleted successfully!');
    }

    public function updateStatus(Todo $todo, Request $request)
    {
        $request->validate([
            'status' => 'required|in:active,in_progress,completed'
        ]);

        $todo->update([
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Todo status updated successfully'
        ]);
    }
}
