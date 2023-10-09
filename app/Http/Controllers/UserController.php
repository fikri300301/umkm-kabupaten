<?php

namespace App\Http\Controllers;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;

class UserController extends Controller
{
    use PasswordValidationRules;
    public function indexDashboard()
    {
        return view('dashboard.manage-users.manage-users');
    }

    public function account()
    {
        return view('dashboard.manage-account.account', [
            'data' => Auth::user(),
        ]);
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:users,name,' . Auth::id()],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'phone' => ['required', 'string', 'regex:/^(\+62|62|0)8[0-9]{6,14}$/', 'unique:users,phone,' . Auth::id()],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $user = User::findOrFail(Auth::id());
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Diudapte!',
            ]);
        } catch (\Throwable $th) {
            Log::error('error update profile', [
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'currentPassword' => [
                'required',
                function ($attribute, $value, $fail) {
                    $password = Auth::user()->password;
                    if (!Hash::check($value, $password)) {
                        $fail('Password saat ini salah');
                    }
                },
            ],
            'passwordBaru' => [
                'required',
                'string',
                'min:8',
            ],
            'konfimasiPassword' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value !== $request->input('passwordBaru')) {
                        $fail('Password baru tidak sama dengan konfirmasi password');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $user = User::findOrFail(Auth::id());
            $user->update([
                'password' => Hash::make($request->passwordBaru),
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Diudapte!',
            ]);
        } catch (\Throwable $th) {
            Log::error('error update profile password', [
                'error' => $th->getMessage(),
            ]);
        }
    }
}