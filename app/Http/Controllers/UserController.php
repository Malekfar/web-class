<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;

class UserController extends Controller
{
    public function index(): Factory|View
    {
        $users = Cache::remember('users', 36000, function () {
            return \App\Models\User::all();
        });
        return view('users.index', ['users' => $users]);
    }

    public function create(): Factory|View
    {
        return view('users.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        User::create($data);
        Cache::forget('users');
        return redirect()->route('users.index');
    }

    public function edit(User $user): Factory|View
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());
        return redirect()->route('users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
