<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'today');
        $now = Carbon::now();

        switch ($filter) {
            case 'today':
                $start = $now->clone()->startOfDay();
                break;
            case 'week':
                $start = $now->clone()->startOfWeek();
                break;
            case 'year':
                $start = $now->clone()->startOfYear();
                break;
            default:
                $start = $now->clone()->startOfMonth();
        }

        $pendapatan = Order::whereBetween('order_date', [$start, $now])
            ->whereIn('status', ['selesai', 'lunas'])
            ->sum('price_total');

        $order_selesai = Order::whereBetween('order_date', [$start, $now])
            ->where('status', 'selesai')
            ->count();

        $order_proses = Order::whereBetween('order_date', [$start, $now])
            ->whereIn('status', ['dipesan', 'didesain'])
            ->count();

        $chartStart = $now->clone()->subMonth()->startOfDay();
        $chart = Order::select(
                DB::raw('DATE(order_date) as tanggal'),
                DB::raw('SUM(price_total) as total_pendapatan'),
                DB::raw('COUNT(id) as total_order')
            )
            ->whereBetween('order_date', [$chartStart, $now])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $tanggal_labels = [];
        $chart_pendapatan = [];
        $chart_order = [];

        foreach ($chart as $data) {
            $tanggal_labels[] = Carbon::parse($data->tanggal)->format('d M');
            $chart_pendapatan[] = (float) $data->total_pendapatan;
            $chart_order[] = (int) $data->total_order;
        }

        return view('dashboard.index', compact(
            'pendapatan',
            'order_selesai',
            'order_proses',
            'chart_pendapatan',
            'chart_order',
            'tanggal_labels',
            'filter'
        ));
    }
}
