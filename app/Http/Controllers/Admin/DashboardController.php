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
        $this->apiBaseUrl = 'http://localhost:8001';
    }

    public function index()
    {
        try {
            $response = Http::timeout(10)
                ->withOptions(['verify' => false])
                ->get($this->apiBaseUrl . '/api/dashboard');

            if ($response->successful()) {
                $data = $response->json();

                return view('admin.dashboard', [
                    'totalLaporan' => $data['total'] ?? 0,
                    'laporanMenunggu' => $data['menunggu'] ?? 0,
                    'laporanDiproses' => $data['diproses'] ?? 0,
                    'laporanSelesai' => $data['selesai'] ?? 0,
                    'chartData' => [
                        'labels' => $data['chart_labels'] ?? [],
                        'menunggu' => $data['chart_data']['menunggu'] ?? [],
                        'diproses' => $data['chart_data']['diproses'] ?? [],
                        'terselesaikan' => $data['chart_data']['terselesaikan'] ?? [],
                        'ditolak' => $data['chart_data']['ditolak'] ?? [],
                    ]
                ]);
            } else {
                return $this->showFallbackView();
            }
        } catch (\Exception $e) {
            \Log::error('Dashboard API Error: ' . $e->getMessage());
            return $this->showFallbackView();
        }
    }

    private function showFallbackView()
    {
        $labels = [];
        for ($i = 6; $i >= 0; $i--) {
            $labels[] = now()->subDays($i)->format('d M');
        }

        return view('admin.dashboard', [
            'totalLaporan' => 7,
            'laporanMenunggu' => 2,
            'laporanDiproses' => 2,
            'laporanSelesai' => 3,
            'chartData' => [
                'labels' => $labels,
                'menunggu' => [1, 1, 0, 0, 0, 0, 0],
                'diproses' => [0, 0, 1, 0, 0, 0, 1],
                'terselesaikan' => [0, 0, 0, 1, 1, 1, 0],
                'ditolak' => [0, 0, 0, 0, 0, 0, 0],
            ]
        ]);
    }

    public function filter(Request $request)
    {
        try {
            $status = $request->get('status', 'all');
            $tanggal = $request->get('tanggal', '7hari');

            $response = Http::timeout(10)
                ->withOptions(['verify' => false])
                ->get($this->apiBaseUrl . '/api/dashboard/filter', [
                    'status' => $status,
                    'tanggal' => $tanggal,
                ]);

            if ($response->successful()) {
                $data = $response->json();

                // Pastikan struktur data sesuai dengan yang diharapkan JavaScript
                return response()->json([
                    'labels' => $data['labels'] ?? [],
                    'datasets' => [
                        'menunggu' => $data['datasets']['menunggu'] ?? [],
                        'diproses' => $data['datasets']['diproses'] ?? [],
                        'terselesaikan' => $data['datasets']['terselesaikan'] ?? [],
                        'ditolak' => $data['datasets']['ditolak'] ?? [],
                    ]
                ]);
            } else {
                \Log::error('Filter API Error: ' . $response->status());
                return response()->json($this->getFallbackChartData(), 200);
            }
        } catch (\Exception $e) {
            \Log::error('Filter Exception: ' . $e->getMessage());
            return response()->json($this->getFallbackChartData(), 200);
        }
    }

    private function getFallbackChartData()
    {
        $labels = [];
        for ($i = 6; $i >= 0; $i--) {
            $labels[] = now()->subDays($i)->format('d M');
        }

        return [
            'labels' => $labels,
            'datasets' => [
                'menunggu' => [1, 0, 1, 0, 0, 0, 1],
                'diproses' => [0, 1, 0, 1, 0, 1, 0],
                'terselesaikan' => [0, 0, 0, 0, 1, 0, 0],
                'ditolak' => [0, 0, 0, 0, 0, 0, 0]
            ]
        ];
    }
}
