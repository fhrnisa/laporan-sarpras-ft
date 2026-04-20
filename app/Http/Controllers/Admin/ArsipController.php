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

            return view('admin.arsip.index', [
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
        $ids = $request->ids;

        if (!$ids || count($ids) === 0) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data yang dipilih'
            ], 400);
        }

        try {
            \App\Models\Laporan::whereIn('id', $ids)->restore();

            return response()->json([
                'success' => true,
                'message' => 'Laporan berhasil dipulihkan'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memulihkan laporan'
            ], 500);
        }
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
