<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Helpers\AdminHelper;

class AdminController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('BE_API_URL', 'http://localhost:8001/api');
    }

    // Method untuk halaman kontrol-admin (view)
    public function index(Request $request)
    {
        // 1. Inisialisasi awal agar tidak "Undefined"
        $params = [
            'page' => $request->query('page', 1),
            'limit' => 10,
        ]; 

        // 2. Cek role (Logika Helper Anda)
        if (!AdminHelper::isAdmin() && AdminHelper::isViewer()) {
            return view('admin.kontrol-admin.index', [
                'admins' => collect([]),
                'total' => 0,
                'error' => null,
                'readonly' => true 
            ]);
        }

        try {
            // 3. Isi params berdasarkan request (Filter & Search)
            if ($request->has('status') && $request->status !== 'all') {
                $params['status'] = $request->status;
            }
            if ($request->has('tanggal')) {
                $params['tanggal'] = $request->tanggal;
            }
            if ($request->has('search')) {
                $params['search'] = $request->search;
            }

            // 4. Panggil API dengan params yang sudah terisi
            $response = Http::get("{$this->apiUrl}/admin/admins", $params);


            if ($response->successful()) {
                $data = $response->json();
                $admins = collect($data['data'] ?? [])->map(fn($admin) => (object) $admin);

                return view('admin.kontrol-admin.index', [
                    'admins' => collect($data['data'] ?? [])->map(fn($a) => (object) $a),
                    'total' => $data['total'] ?? 0,
                    'currentPage' => $data['current_page'] ?? 1,
                    'lastPage' => $data['last_page'] ?? 1,
                    'error' => null
                ]);
            }
            
            // Handle jika API gagal
            throw new \Exception('Gagal mengambil data dari API Back-End');

        } catch (\Exception $e) {
            return view('admin.kontrol-admin.index', [
                'admins' => collect([]),
                'total' => 0,
                'error' => $e->getMessage()
            ]);
        }
    }

    // Method untuk menyimpan admin baru (API call)
    public function store(Request $request)
    {
        try {
            \Log::info('FE Admin Store Request:', $request->all());

            // Data yang akan dikirim ke BE
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'nomor_telepon' => $request->nomor_telepon,
                'role' => $request->role,
                'status' => $request->status ?? 'aktif',
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation
            ];

            \Log::info('Data to BE:', $data);

            // Kirim ke BE API
            $response = Http::post("{$this->apiUrl}/admin/admins", $data);

            \Log::info('BE Response Status:', ['status' => $response->status()]);
            \Log::info('BE Response Body:', $response->json());

            if ($response->successful()) {
                $result = $response->json();
                return response()->json([
                    'success' => true,
                    'message' => $result['message'] ?? 'Admin berhasil ditambahkan',
                    'data' => $result['data'] ?? null
                ]);
            } else {
                $errorData = $response->json();
                return response()->json([
                    'success' => false,
                    'message' => $errorData['message'] ?? 'Gagal menambahkan admin',
                    'errors' => $errorData['errors'] ?? null
                ], $response->status());
            }

        } catch (\Exception $e) {
            \Log::error('FE AdminStore Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $response = Http::get("{$this->apiUrl}/admin/admins/{$id}");

            return response()->json($response->json());

        } catch (\Exception $e) {
            \Log::error('FE AdminShow Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $response = Http::put("{$this->apiUrl}/admin/admins/{$id}", $request->all());

            return response()->json($response->json());

        } catch (\Exception $e) {
            \Log::error('FE AdminUpdate Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete("{$this->apiUrl}/admin/admins/{$id}");

            return response()->json($response->json());

        } catch (\Exception $e) {
            \Log::error('FE AdminDestroy Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroyMultiple(Request $request)
    {
        try {
            $response = Http::post("{$this->apiUrl}/admin/admins/delete-multiple", $request->all());

            return response()->json($response->json());

        } catch (\Exception $e) {
            \Log::error('FE AdminDestroyMultiple Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $response = Http::put("{$this->apiUrl}/admin/admins/{$id}/status", $request->all());

            return response()->json($response->json());

        } catch (\Exception $e) {
            \Log::error('FE AdminUpdateStatus Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateLastActive(Request $request, $id)
    {
        try {
            $response = Http::put("{$this->apiUrl}/admin/admins/{$id}/last-active", $request->all());

            return response()->json($response->json());

        } catch (\Exception $e) {
            \Log::error('FE AdminUpdateLastActive Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
