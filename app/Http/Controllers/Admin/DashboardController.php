<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(): View
    {
        $totalPeserta = Registration::count();
        $pesertaSd = Registration::where('category', 'sd')->count();
        $pesertaSmp = Registration::where('category', 'smp')->count();
        $pendaftaranHariIni = Registration::whereDate('registered_at', Carbon::today())->count();

        // 7 days trend data for chart
        $last7Days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dateStr = $date->format('Y-m-d');
            $label = $date->translatedFormat('d M');

            $sdCount = Registration::where('category', 'sd')
                ->whereDate('registered_at', $dateStr)
                ->count();

            $smpCount = Registration::where('category', 'smp')
                ->whereDate('registered_at', $dateStr)
                ->count();

            $last7Days->push([
                'date' => $dateStr,
                'label' => $label,
                'sd' => $sdCount,
                'smp' => $smpCount,
                'total' => $sdCount + $smpCount,
            ]);
        }

        // Recent registrations
        $recentRegistrations = Registration::orderBy('registered_at', 'desc')
            ->orderBy('id', 'desc')
            ->take(7)
            ->get();

        return view('admin.dashboard', compact(
            'totalPeserta',
            'pesertaSd',
            'pesertaSmp',
            'pendaftaranHariIni',
            'last7Days',
            'recentRegistrations'
        ));
    }
}
