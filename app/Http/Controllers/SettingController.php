<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index():View
    {
        return view('dashboard.setting');
    }

    public function edit(User $account): View
    {
        return view('dashboard.setting', compact('account'));
    }

    public function update(UpdateUserRequest $request, User $account): RedirectResponse
    {
        $data = $request->validated();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $account->update($data);

        return redirect()->route('dashboard.seting')->with('success', 'Data berhasil diperbarui!');
    }
}
