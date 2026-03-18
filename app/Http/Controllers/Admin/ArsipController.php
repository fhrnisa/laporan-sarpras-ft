<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Routing\Controller;

class ArsipController extends Controller
{
    private string $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = 'http://localhost:8001';
    }

    /**
     * Menampilkan halaman arsip (FE)
     */
    public function index(Request $request)
    {
        try {
            // Query params ke BE
            $queryParams = $request->only(['status', 'tanggal', 'search']);

            // Call API BE
            $response = Http::get($this->apiBaseUrl . '/api/admin/arsip', $queryParams);

            if (!$response->successful()) {
                throw new \Exception('Response API gagal');
            }

            $json = $response->json();

            // VALIDASI STRUKTUR RESPONSE
            $laporan = $json['data'] ?? [];
            $total   = $json['total'] ?? count($laporan);

            return view('admin.arsip', [
                'laporan' => $laporan,
                'total'   => $total
            ]);

        } catch (\Throwable $e) {
            \Log::error('FE Arsip Error: ' . $e->getMessage());

            return view('admin.arsip.index', [
                'laporan' => [],
                'total'   => 0,
                'error'   => 'Gagal mengambil data arsip'
            ]);
        }
    }

    /**
     * Restore arsip
     */
    public function restore(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer'
        ]);

        $response = Http::post(
            $this->apiBaseUrl . '/api/admin/arsip/restore',
            ['ids' => $request->ids]
        );

        return response()->json($response->json(), $response->status());
    }

    /**
     * Hapus permanen arsip
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer'
        ]);

        $response = Http::post(
            $this->apiBaseUrl . '/api/admin/arsip/destroy',
            ['ids' => $request->ids]
        );

        return response()->json($response->json(), $response->status());
    }
}
