<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ArsipController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('BE_API_URL', 'http://localhost:8001/api');
    }

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

            $response = Http::get("{$this->apiUrl}/admin/laporan/arsip", $params);

            if ($response->successful()) {
                $data = $response->json();

                return view('admin.arsip', [
                    'laporan' => $data['data'] ?? [],
                    'total' => $data['count'] ?? 0,
                    'error' => null
                ]);
            } else {
                return view('admin.arsip', [
                    'laporan' => [],
                    'total' => 0,
                    'error' => 'Gagal mengambil data arsip'
                ]);
            }

        } catch (\Exception $e) {
            return view('admin.arsip', [
                'laporan' => [],
                'total' => 0,
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    // Method untuk memulihkan data dari arsip
    public function restore(Request $request)
    {
        try {
            $response = Http::post("{$this->apiUrl}/admin/laporan/pulihkan", [
                'ids' => $request->ids
            ]);

            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memulihkan data'
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Method untuk menghapus permanen
    public function destroy(Request $request)
    {
        try {
            $response = Http::post("{$this->apiUrl}/admin/laporan/hapus-permanen", [
                'ids' => $request->ids
            ]);

            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus data'
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
