<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

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
        try {
            $params = [];

            if ($request->has('status') && $request->status !== 'all') {
                $params['status'] = $request->status;
            }

            if ($request->has('tanggal')) {
                $params['tanggal'] = $request->tanggal;
            }

            if ($request->has('search')) {
                $params['search'] = $request->search;
            }

            // Mengambil data admin dari BE
            $response = Http::get("{$this->apiUrl}/admin/admins", $params);

            if ($response->successful()) {
                $data = $response->json();

                // Konversi array ke collection agar bisa diakses dengan cara yang sama
                $admins = collect($data['data'] ?? [])->map(function ($admin) {
                    // Convert array to object-like structure
                    return (object) $admin;
                });

                return view('admin.kontrol-admin', [
                    'admins' => $admins,
                    'total' => $data['total'] ?? $data['count'] ?? 0,
                    'error' => null
                ]);
            } else {
                return view('admin.kontrol-admin', [
                    'admins' => collect([]),
                    'total' => 0,
                    'error' => 'Gagal mengambil data admin'
                ]);
            }

        } catch (\Exception $e) {
            \Log::error('FE AdminController Error: ' . $e->getMessage());

            return view('admin.kontrol-admin', [
                'admins' => collect([]),
                'total' => 0,
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    // Method untuk API calls (AJAX) di FE
    public function store(Request $request)
    {
        try {
            $response = Http::post("{$this->apiUrl}/admin/admins", $request->all());

            return response()->json($response->json());

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
