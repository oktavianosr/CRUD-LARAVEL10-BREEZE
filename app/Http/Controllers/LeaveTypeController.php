<?php

namespace App\Http\Controllers;

use App\Models\LeaveTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LeaveTypeController extends Controller
{
    public function index(Request $request)
    {
        $leaveType = LeaveTypes::when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('leave_types.index', compact('leaveType'));
    }

    public function create()
    {
        return view('leave_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        LeaveTypes::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'description' => $request->description ? json_encode($request->description) : null,
        ]);

        return redirect()->route('leave_types.index')->with('success', 'Leave type created successfully.');
    }

    public function edit(LeaveTypes $leaveType)
    {
        return view('leave_types.edit', compact('leaveType'));
    }

    public function update(Request $request, LeaveTypes $leaveType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|array',
        ]);

        $leaveType->update([
            'name' => $request->name,
            'description' => $request->description ? json_encode($request->description) : null,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('leave_types.index')->with('success', 'Leave type updated successfully.');
    }

    public function destroy(LeaveTypes $leaveType)
    {
        $leaveType->delete();

        return redirect()->route('leave_types.index')->with('success', 'Leave type deleted successfully.');
    }
}
