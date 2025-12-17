<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Routing\Controller;

class LaporanController extends Controller
{
    private $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = 'http://localhost:8001';
    }

    /**
     * Menampilkan halaman laporan di FE
     */
    public function index(Request $request)
    {
        try {
            $queryParams = [];

            if ($request->has('status') && $request->status !== 'all') {
                $queryParams['status'] = $request->status;
            }

            if ($request->has('tanggal') && $request->tanggal !== 'all') {
                $queryParams['tanggal'] = $request->tanggal;
            }

            if ($request->has('search') && !empty($request->search)) {
                $queryParams['search'] = $request->search;
            }

            // Panggil API BE untuk data laporan AKTIF
            $response = Http::get($this->apiBaseUrl . '/api/admin/laporan', $queryParams);

            $laporan = [];
            $total = 0;

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['success']) && $data['success']) {
                    $laporan = $data['data'] ?? [];
                    $total = $data['total'] ?? count($laporan);
                }
            }

            return view('admin.laporan', [
                'laporan' => $laporan,
                'total' => $total,
                'filters' => [
                    'status' => $request->status ?? 'all',
                    'tanggal' => $request->tanggal ?? 'all',
                    'search' => $request->search ?? ''
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Laporan FE Error: ' . $e->getMessage());

            return view('admin.laporan', [
                'laporan' => [],
                'total' => 0,
                'error' => 'Gagal mengambil data laporan. Pastikan backend API berjalan.',
                'filters' => [
                    'status' => $request->status ?? 'all',
                    'tanggal' => $request->tanggal ?? 'all',
                    'search' => $request->search ?? ''
                ]
            ]);
        }
    }

    /**
     * Mengarsipkan laporan (POST dari FE)
     */
    public function archive(Request $request)
    {
        try {
            $request->validate([
                'ids' => 'required|array',
                'ids.*' => 'integer'
            ]);

            $response = Http::post($this->apiBaseUrl . '/api/admin/laporan/archive', [
                'ids' => $request->ids
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'success' => true,
                    'message' => $data['message'] ?? 'Berhasil mengarsipkan laporan',
                    'count' => $data['count'] ?? 0
                ]);
            } else {
                $errorData = $response->json();
                return response()->json([
                    'success' => false,
                    'message' => $errorData['message'] ?? 'Gagal mengarsipkan data di backend'
                ], $response->status());
            }

        } catch (\Exception $e) {
            \Log::error('Archive Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengarsipkan'
            ], 500);
        }
    }

    /**
     * Hapus permanen dari halaman laporan (TAMBAHKAN INI)
     */
    public function destroy(Request $request)
    {
        try {
            $request->validate([
                'ids' => 'required|array',
                'ids.*' => 'integer'
            ]);

            \Log::info('FE Laporan Destroy - Data dikirim:', $request->all());

            // KUNCI: Endpoint yang benar
            $response = Http::post($this->apiBaseUrl . '/api/admin/laporan/destroy', [
                'ids' => $request->ids
            ]);

            \Log::info('FE Laporan Destroy - Response:', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'success' => true,
                    'message' => $data['message'] ?? 'Berhasil menghapus permanen',
                    'count' => $data['count'] ?? 0
                ]);
            } else {
                $errorData = $response->json();
                return response()->json([
                    'success' => false,
                    'message' => $errorData['message'] ?? 'Gagal menghapus data di backend'
                ], $response->status());
            }

        } catch (\Exception $e) {
            \Log::error('FE Laporan Destroy Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus permanen: ' . $e->getMessage()
            ], 500);
        }
    }

}
