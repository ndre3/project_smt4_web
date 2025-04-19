<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use app\Models\User;
use App\Models\Sampah;
use app\Models\Berita;

class VisualisasiController extends Controller
{
    public function index(){
        return view('pages.visualisasi');
    }

    public function pengguna()
    {
        $data = [
            'admin' => User::where('role', 'admin')->count(),
            'sopir' => User::where('role', 'sopir')->count(),
            'user'  => User::where('role', 'masyarakat')->count(),
        ];

        return view('pages.visualisasi_pengguna', compact('data'));
    }

    public function laporan()
    {
        return view('pages.visualisasi_laporan');
    }

    public function sampah()
    {
        // Siapkan data periode
        $data = [
            'harian' => $this->getSampahByPeriode('harian'),
            'mingguan' => $this->getSampahByPeriode('mingguan'),
            'bulanan' => $this->getSampahByPeriode('bulanan'),
            'tahunan' => $this->getSampahByPeriode('tahunan'),
        ];

        $labels = [
            'harian' => $this->getLabels('harian'),
            'mingguan' => $this->getLabels('mingguan'),
            'bulanan' => $this->getLabels('bulanan'),
            'tahunan' => $this->getLabels('tahunan'),
        ];

        // Hitung total sampah
        $totalSampah = Sampah::sum('jumlah_sampah');

        return view('pages.visualisasi_sampah', compact('data', 'labels', 'totalSampah'));
    }

    public function getSampahData(Request $request)
    {
        $periode = $request->periode ?? 'harian';
        $startDate = $request->start ? Carbon::parse($request->start) : null;
        $endDate = $request->end ? Carbon::parse($request->end) : null;

        $data = $this->getSampahByPeriode($periode, $startDate, $endDate);
        $labels = $this->getLabels($periode, $startDate, $endDate);

        return response()->json([
            'data' => $data,
            'labels' => $labels
        ]);
    }

    private function getSampahByPeriode($periode, $startDate = null, $endDate = null)
    {
        $query = Sampah::query();
        
        // Filter tanggal jika disediakan
        if ($startDate && $endDate) {
            $query->whereBetween('tanggal', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')]);
        }
        
        // Grup berdasarkan periode yang dipilih
        switch ($periode) {
            case 'harian':
                // Data harian (30 hari terakhir jika tidak ada filter)
                if (!$startDate) {
                    $startDate = Carbon::now()->subDays(29);
                    $endDate = Carbon::now();
                    $query->whereBetween('tanggal', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')]);
                }
                
                $data = $query->select(
                    'tanggal', 
                    DB::raw('SUM(jumlah_sampah) as total')
                )
                ->groupBy('tanggal')
                ->orderBy('tanggal')
                ->get()
                ->pluck('total', 'tanggal')
                ->toArray();
                
                // Mengisi semua tanggal dalam rentang
                $result = [];
                $current = clone $startDate;
                while ($current <= $endDate) {
                    $date = $current->format('Y-m-d');
                    $result[] = isset($data[$date]) ? $data[$date] : 0;
                    $current->addDay();
                }
                break;
                
            case 'mingguan':
                // Data mingguan (12 minggu terakhir jika tidak ada filter)
                if (!$startDate) {
                    $startDate = Carbon::now()->subWeeks(11)->startOfWeek();
                    $endDate = Carbon::now();
                    $query->whereBetween('tanggal', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')]);
                }
                
                $data = $query->select(
                    DB::raw('YEARWEEK(tanggal, 1) as yearweek'),
                    DB::raw('SUM(jumlah_sampah) as total')
                )
                ->groupBy('yearweek')
                ->orderBy('yearweek')
                ->get()
                ->keyBy('yearweek')
                ->map(function ($item) {
                    return $item->total;
                })
                ->toArray();
                
                $result = [];
                $current = clone $startDate->startOfWeek();
                while ($current <= $endDate) {
                    $yearweek = $current->format('oW');
                    $result[] = isset($data[$yearweek]) ? $data[$yearweek] : 0;
                    $current->addWeek();
                }
                break;
                
            case 'bulanan':
                // Data bulanan (12 bulan terakhir jika tidak ada filter)
                if (!$startDate) {
                    $startDate = Carbon::now()->subMonths(11)->startOfMonth();
                    $endDate = Carbon::now();
                    $query->whereBetween('tanggal', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')]);
                }
                
                $data = $query->select(
                    DB::raw('DATE_FORMAT(tanggal, "%Y-%m") as month'),
                    DB::raw('SUM(jumlah_sampah) as total')
                )
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->pluck('total', 'month')
                ->toArray();
                
                $result = [];
                $current = clone $startDate->startOfMonth();
                while ($current <= $endDate) {
                    $month = $current->format('Y-m');
                    $result[] = isset($data[$month]) ? $data[$month] : 0;
                    $current->addMonth();
                }
                break;
                
            case 'tahunan':
                // Data tahunan (5 tahun terakhir jika tidak ada filter)
                if (!$startDate) {
                    $startDate = Carbon::now()->subYears(4)->startOfYear();
                    $endDate = Carbon::now();
                    $query->whereBetween('tanggal', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')]);
                }
                
                $data = $query->select(
                    DB::raw('YEAR(tanggal) as year'),
                    DB::raw('SUM(jumlah_sampah) as total')
                )
                ->groupBy('year')
                ->orderBy('year')
                ->get()
                ->pluck('total', 'year')
                ->toArray();
                
                $result = [];
                $current = clone $startDate->startOfYear();
                while ($current->year <= $endDate->year) {
                    $year = $current->year;
                    $result[] = isset($data[$year]) ? $data[$year] : 0;
                    $current->addYear();
                }
                break;
        }
        
        return $result;
    }

    private function getLabels($periode, $startDate = null, $endDate = null)
    {
        // Mengatur nilai default untuk tanggal
        if (!$startDate || !$endDate) {
            switch ($periode) {
                case 'harian':
                    $startDate = Carbon::now()->subDays(29);
                    $endDate = Carbon::now();
                    break;
                case 'mingguan':
                    $startDate = Carbon::now()->subWeeks(11)->startOfWeek();
                    $endDate = Carbon::now();
                    break;
                case 'bulanan':
                    $startDate = Carbon::now()->subMonths(11)->startOfMonth();
                    $endDate = Carbon::now();
                    break;
                case 'tahunan':
                    $startDate = Carbon::now()->subYears(4)->startOfYear();
                    $endDate = Carbon::now();
                    break;
            }
        }

        $labels = [];
        switch ($periode) {
            case 'harian':
                $current = clone $startDate;
                while ($current <= $endDate) {
                    $labels[] = $current->format('d/m/Y');
                    $current->addDay();
                }
                break;
                
            case 'mingguan':
                $current = clone $startDate->startOfWeek();
                while ($current <= $endDate) {
                    $weekStart = clone $current;
                    $weekEnd = (clone $current)->endOfWeek();
                    $labels[] = $weekStart->format('d/m') . ' - ' . $weekEnd->format('d/m/Y');
                    $current->addWeek();
                }
                break;
                
            case 'bulanan':
                $current = clone $startDate->startOfMonth();
                while ($current <= $endDate) {
                    $labels[] = $current->format('M Y');
                    $current->addMonth();
                }
                break;
                
            case 'tahunan':
                $current = clone $startDate->startOfYear();
                while ($current->year <= $endDate->year) {
                    $labels[] = (string) $current->year;
                    $current->addYear();
                }
                break;
        }
        
        return $labels;
    }
    }