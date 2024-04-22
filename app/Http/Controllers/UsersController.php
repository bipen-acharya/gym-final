<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(20);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sanitized = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'user_role' => 'required',
            'photo' => 'required',
            'description' => 'nullable',
            'cost_per_month' => 'nullable',
            'experience' => 'nullable'
        ]);

        $sanitized['password'] = Hash::make($sanitized['password']);

        $user = User::create($sanitized);

        $user->addMedia($sanitized['photo'])->toMediaCollection();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $sanitized = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'user_role' => 'required',
            'description' => 'nullable',
            'cost_per_month' => 'nullable',
            'experience' => 'nullable'
        ]);
        if ($request->has('password') && $request->password !== null) {
            $sanitized['password'] = Hash::make($request->password);
        }

        $user->update($sanitized);

        if ($request->has('photo') && $request->photo !== null) {
            $user->clearMediaCollection();
            $user->addMedia($request->photo)->toMediaCollection();
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
