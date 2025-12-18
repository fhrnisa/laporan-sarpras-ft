<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('BE_API_URL', 'http://localhost:8001/api');
    }

    public function showLoginForm()
    {
        // Jika sudah login, redirect ke dashboard
        if (Session::has('user')) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            \Log::info('Login attempt:', ['email' => $request->email]);

            $response = Http::post("{$this->apiUrl}/login", [
                'email' => $request->email,
                'password' => $request->password
            ]);

            if ($response->successful()) {
                $data = $response->json();

                // Simpan data user di session
                Session::put('user', $data['data']['user']);
                Session::put('token', $data['data']['token']);

                \Log::info('Login successful:', ['user' => $data['data']['user']]);

                // Redirect ke dashboard
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil');
            } else {
                $errorData = $response->json();
                \Log::error('Login failed:', $errorData);

                return back()->withErrors([
                    'email' => $errorData['message'] ?? 'Email atau password salah'
                ])->withInput();
            }
        } catch (\Exception $e) {
            \Log::error('Login exception:', ['error' => $e->getMessage()]);

            return back()->withErrors([
                'error' => 'Terjadi kesalahan koneksi ke server'
            ])->withInput();
        }
    }

    public function logout()
    {
        try {
            // Ambil token dari session
            $token = Session::get('token');

            if ($token) {
                // Kirim logout request ke BE
                $response = Http::withToken($token)->post("{$this->apiUrl}/logout");

                if ($response->successful()) {
                    \Log::info('Logout successful from BE');
                } else {
                    \Log::warning('Logout API failed: ' . $response->status());
                }
            }
        } catch (\Exception $e) {
            \Log::error('Logout exception:', ['error' => $e->getMessage()]);
        }

        // Hapus session di FE
        Session::forget(['user', 'token']);
        Session::flush();

        return redirect()->route('auth.login')->with('success', 'Logout berhasil');
    }
}
