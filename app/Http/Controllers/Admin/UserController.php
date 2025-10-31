<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($filter = $request->input('sort')) {
            if (in_array($filter, ['admin', 'kasir', 'desainer'])) {
                $query->where('role', $filter);
            } elseif ($filter === 'terbaru') {
                $query->latest();
            } elseif ($filter === 'terlama') {
                $query->oldest();
            }
        } else {
            $query->latest();
        }

        $users = $query->paginate(10);

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

    public function resetPassword(User $account):RedirectResponse
    {
        $newPassword = 'password123';
        $account->update([
            'password' => Hash::make($newPassword),
        ]);
        return redirect()->route('account.index')->with('success', 'Password user berhasil direset!');
    }
}
