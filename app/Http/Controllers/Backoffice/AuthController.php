<?php namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        // check if login or not
        if (auth()->check()) {
            return redirect()->route('backoffice.dashboard');
        }

        return view('backoffice.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $param = [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($param)) {
            return redirect()->route('backoffice.dashboard');
        }

        return redirect()->back()->with('danger', 'incorect email and password');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('backoffice.login.form');
    }
}
