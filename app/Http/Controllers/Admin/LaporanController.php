<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LaporanController extends Controller
{
    private $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = 'http://localhost:8001';
    }

    public function index(Request $request)
    {
        try {
            // Get data from BE API
            $response = Http::timeout(10)
                ->withOptions(['verify' => false])
                ->get($this->apiBaseUrl . '/api/admin/laporan', [
                    'status' => $request->get('status', 'all'),
                    'tanggal' => $request->get('tanggal', '7hari'),
                    'search' => $request->get('search', '')
                ]);

            if ($response->successful()) {
                $data = $response->json();

                return view('admin.laporan', [
                    'laporan' => $data['data'] ?? [],
                    'total' => $data['count'] ?? 0
                ]);
            } else {
                return view('admin.laporan', [
                    'laporan' => [],
                    'total' => 0,
                    'error' => 'Gagal mengambil data dari server'
                ]);
            }
        } catch (\Exception $e) {
            return view('admin.laporan', [
                'laporan' => [],
                'total' => 0,
                'error' => 'Koneksi ke server gagal: ' . $e->getMessage()
            ]);
        }
    }
}
