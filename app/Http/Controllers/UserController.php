<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{

    public function index(Request $request){
        // $users = User::with('role')->get();
        // return view('users.index', compact('users'));
        $users = User::when($request->search, function ($query,$search){
            $query->where('name','like', "%{$search}%");
        })->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create(){
        $roles = Roles::All();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:roles,id'
        ]);

        $Role = Roles::findOrFail($request->role_id);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $Role->name
        ]);

        return redirect()->route('users.index')->with('success', 'Anggota Berhasil Dibuat');
    }

    public function edit(User $user){
        $roles = Roles::all();
        return view('users.edit',compact('user','roles'));
    }

    public function update(Request $request, User $user){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id
        ]);

        return redirect()->route('users.index')->with('success', 'Anggota Berhasil Di Perbarui');
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Anggota Berhasil Dihapus');
    }
}
