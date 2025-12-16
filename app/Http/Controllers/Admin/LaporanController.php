<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
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

            $response = Http::get("{$this->apiUrl}/admin/laporan", $params);

            if ($response->successful()) {
                $data = $response->json();

                return view('admin.laporan', [
                    'laporan' => $data['data'] ?? [],
                    'total' => $data['count'] ?? 0,
                    'error' => null
                ]);
            } else {
                return view('admin.laporan', [
                    'laporan' => [],
                    'total' => 0,
                    'error' => 'Gagal mengambil data laporan'
                ]);
            }

        } catch (\Exception $e) {
            return view('admin.laporan', [
                'laporan' => [],
                'total' => 0,
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    // Method untuk mengarsipkan laporan
    public function archive(Request $request)
    {
        try {
            $response = Http::post("{$this->apiUrl}/admin/laporan/arsip", [
                'ids' => $request->ids
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return response()->json($data);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengarsipkan laporan'
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
