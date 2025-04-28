<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Roles::when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('level')
            ->paginate(10);

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'nullable|array',
        ]);

        if($request->has('name') && Roles::where('name', $request->name)->exists()) {
            return redirect()->route('roles.index')->with('error', 'Role Sudah Ada.');
        }

        Roles::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'permissions' => $request->permissions ? json_encode($request->permissions) : null,
            'level' => $request->level ?? 3,
        ]);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Roles $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Roles $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'nullable|array',
        ]);

        $role->update([
            'name' => $request->name,
            'permissions' => $request->permissions ? json_encode($request->permissions) : null,
            'level' => $request->level ?? 3,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Roles $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
