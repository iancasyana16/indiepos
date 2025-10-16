<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        return view('dashboard.account', compact('users'));
    }

    public function create(): View
    {
        return view('dashboard.addAccount');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Jika tidak ada password gunakan password default yg dihash
        if (!isset($data['password'])) {
            $data['password'] = Hash::make('password123');
        }

        User::create($data);

        return redirect()->route('account.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $account): View
    {
        return view('dashboard.editAccount', compact('account'));
    }

    public function update(UpdateUserRequest $request, User $account): RedirectResponse
    {
        $data = $request->validated();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $account->update($data);

        return redirect()->route('account.index')->with('success', 'Data user berhasil diperbarui!');
    }


    public function destroy(User $account): RedirectResponse
    {
        $account->delete();

        return redirect()->route('account.index')->with('success', 'User berhasil dihapus!');
    }
}
