<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    private $apiBaseUrl;

    public function __construct()
    {
        // URL API Backend - sesuaikan dengan URL BE Anda
        $this->apiBaseUrl = 'http://127.0.0.1:8001'; // atau http://localhost:8001
    }

    public function index()
    {
        try {
            // Ambil token dari session (jika menggunakan auth)
            $token = session('auth_token');

            \Log::info('Fetching dashboard data from BE', [
                'url' => $this->apiBaseUrl . '/api/dashboard',
                'token' => $token ? 'exists' : 'missing'
            ]);

            // Gunakan withoutVerifying untuk testing (dev only)
            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ])
                ->timeout(30)
                ->get($this->apiBaseUrl . '/api/dashboard');

            \Log::info('Dashboard API Response', [
                'status' => $response->status(),
                'successful' => $response->successful(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                $data = $response->json();

                \Log::info('Dashboard data received', $data);

                return view('admin.dashboard', [
                    'totalLaporan' => $data['total'] ?? 0,
                    'laporanMenunggu' => $data['menunggu'] ?? 0,
                    'laporanDiproses' => $data['diproses'] ?? 0,
                    'laporanSelesai' => $data['selesai'] ?? 0,
                    'laporanDitolak' => $data['ditolak'] ?? 0,
                    'chartLabels' => $data['chart_labels'] ?? [], // PERBAIKAN: ini harus ada
                    'chartData' => [
                        'labels' => $data['chart_labels'] ?? [], // tambah ini juga
                        'menunggu' => $data['chart_data']['menunggu'] ?? [],
                        'diproses' => $data['chart_data']['diproses'] ?? [],
                        'terselesaikan' => $data['chart_data']['terselesaikan'] ?? [],
                        'ditolak' => $data['chart_data']['ditolak'] ?? [],
                    ]
                ]);
            } else {
                \Log::error('Dashboard API failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                // Fallback dengan data dummy untuk testing
                return view('admin.dashboard', [
                    'totalLaporan' => 4,
                    'laporanMenunggu' => 1,
                    'laporanDiproses' => 1,
                    'laporanSelesai' => 1,
                    'laporanDitolak' => 1,
                    'chartLabels' => ['5 Des', '6 Des', '7 Des', '8 Des', '9 Des', '10 Des', '11 Des'],
                    'chartData' => [
                        'labels' => ['5 Des', '6 Des', '7 Des', '8 Des', '9 Des', '10 Des', '11 Des'],
                        'menunggu' => [1, 0, 0, 0, 0, 0, 0],
                        'diproses' => [0, 1, 0, 0, 0, 0, 0],
                        'terselesaikan' => [0, 0, 0, 0, 1, 0, 0],
                        'ditolak' => [0, 0, 0, 0, 0, 0, 1],
                    ]
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Dashboard controller error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            // Fallback jika ada error
            return view('admin.dashboard', [
                'totalLaporan' => 4,
                'laporanMenunggu' => 1,
                'laporanDiproses' => 1,
                'laporanSelesai' => 1,
                'laporanDitolak' => 1,
                'chartLabels' => ['5 Des', '6 Des', '7 Des', '8 Des', '9 Des', '10 Des', '11 Des'],
                'chartData' => [
                    'labels' => ['5 Des', '6 Des', '7 Des', '8 Des', '9 Des', '10 Des', '11 Des'],
                    'menunggu' => [1, 0, 0, 0, 0, 0, 0],
                    'diproses' => [0, 1, 0, 0, 0, 0, 0],
                    'terselesaikan' => [0, 0, 0, 0, 1, 0, 0],
                    'ditolak' => [0, 0, 0, 0, 0, 0, 1],
                ]
            ]);
        }
    }

    public function filter(Request $request)
    {
        try {
            $token = session('auth_token');

            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ])
                ->get($this->apiBaseUrl . '/api/dashboard/filter', [
                    'status' => $request->get('status', 'all'),
                    'tanggal' => $request->get('tanggal', '7hari'),
                ]);

            if ($response->successful()) {
                return response()->json($response->json());
            }

            return response()->json([
                'labels' => ['5 Des', '6 Des', '7 Des', '8 Des', '9 Des', '10 Des', '11 Des'],
                'datasets' => [
                    'menunggu' => [1, 0, 0, 0, 0, 0, 0],
                    'diproses' => [0, 1, 0, 0, 0, 0, 0],
                    'terselesaikan' => [0, 0, 0, 0, 1, 0, 0],
                    'ditolak' => [0, 0, 0, 0, 0, 0, 1]
                ],
                'summary' => [
                    'total' => 4,
                    'menunggu' => 1,
                    'diproses' => 1,
                    'selesai' => 1
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'labels' => ['5 Des', '6 Des', '7 Des', '8 Des', '9 Des', '10 Des', '11 Des'],
                'datasets' => [
                    'menunggu' => [1, 0, 0, 0, 0, 0, 0],
                    'diproses' => [0, 1, 0, 0, 0, 0, 0],
                    'terselesaikan' => [0, 0, 0, 0, 1, 0, 0],
                    'ditolak' => [0, 0, 0, 0, 0, 0, 1]
                ],
                'summary' => [
                    'total' => 4,
                    'menunggu' => 1,
                    'diproses' => 1,
                    'selesai' => 1
                ]
            ]);
        }
    }
}
