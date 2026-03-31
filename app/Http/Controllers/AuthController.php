<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService)
    {
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'id' => 'required|string',
            'password' => 'required|string',
        ]);

        $result = $this->authService->login($request->id, $request->password);

        if ($result['success']) {
            return redirect('/checkin')->with('success', 'Logged in successfully.');
        }

        return back()->withErrors(['error' => $result['message']]);
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('login');
    }
}
