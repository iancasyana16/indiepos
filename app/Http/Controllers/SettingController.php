<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class SettingController extends Controller
{
    public function index(): View
    {
        $account = Auth::user();
        return view('dashboard.setting', compact('account'));
    }

    public function update(Request $request): RedirectResponse
    {
        $account = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $account->id,
            'password' => 'nullable|string|min:6|confirmed', 
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $account->update($data);

        return redirect()->route('setting.index')->with('success', 'Data berhasil diperbarui!');
    }
}
