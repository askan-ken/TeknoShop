<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $timeRange = [
            'start_time' => request('start_time'),
            'end_time' => request('end_time')
        ];
        $transactions = Transaction::with('purchases.product', 'user')->betweenTimeRange($timeRange)->orderBy('id', 'DESC')->paginate(20);
        return view('dashboard.pages.reports.index', [
            'title' => 'Laporan Pendapatan',
            'transactions' => $transactions
        ]);
    }

    public function print()
    {
        $date = Carbon::parse(request('start_time'))->isoFormat('DD MMMM YY')." - ".Carbon::parse(request('end_time'))->isoFormat('DD MMMM YY');
        $status = 'Semua';
        // if( !empty(request('status')) ) :
        //     $status = request('status');
        // endif;
        // if( !empty(request('date')) ) :
        //     if( request('date') == 'bulan ini' ) :
        //         $date = Carbon::now()->isoFormat('MMMM Y');
        //     elseif( request('date') == 'tahun ini' ) :
        //         $date =  Carbon::now()->isoFormat('Y');
        //     elseif( request('date') == 'hari ini' ) :
        //         $date =  Carbon::now()->isoFormat('D MMMM Y');
        //     elseif( request('date') == 'minggu ini' ) :
        //         $date =  Carbon::now()->startOfWeek()->isoFormat('D MMMM Y') . ' - ' . Carbon::now()->endOfWeek()->isoFormat('D MMMM Y');
        //     endif;
        // endif;

        $timeRange = [
            'start_time' => request('start_time'),
            'end_time' => request('end_time')
        ];

        return view('dashboard.pages.reports.print', [
            'title' => 'Data Pembelian ' . $date,
            'date' => $date,
            'status' => $status,
            'transactions' => Transaction::with('purchases.product', 'user')->betweenTimeRange($timeRange)->get()
        ]);
    }
}