<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except(['logout']);
    }

    public function index()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        
        if (Auth::attempt($credentials)) {
            $response = [
                'success' => true,
                'message' => 'Login successful',
            ];

            $remember = $request->input('remember') == 'true';
            if ($remember) {
                $expirationDate = now()->addMonth();
                $response['remember_cookie'] = [
                    'name' => 'remember',
                    'value' => 'true',
                    'expiration' => $expirationDate->toDateTimeString(),
                ];
                $response['user_data'] = [
                    'name' => 'user_data',
                    'value' => json_encode($credentials),
                    'expiration' => $expirationDate->toDateTimeString(),
                ];
            }

            return response()->json($response);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials',
        ]);
    }


    public function registerPage()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }
}
