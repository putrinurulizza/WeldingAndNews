<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Log;
use App\Models\Welder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $check = Log::where('visitor_ip', $request->ip())->whereDate('created_at', '=', (new \DateTime())->format('Y-m-d'))->first();

        if(!isset($check)){
            Log::create(['visitor_ip' => $request->ip()]);
        }

        $chartData = [];
        $chartLabels = [];
        $data = $this->grafis();

        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        foreach ($data as $record) {
            $formattedDate = date('d M Y', strtotime($record->visit_date));
            if ($record->visit_date == $today) {
                $chartLabels[] = "Hari Ini";
            } else if($record->visit_date == $yesterday){
                $chartLabels[] = "Kemarin";
            } else {
                $chartLabels[] = $formattedDate;
            }
            $chartData[] = $record->record_count;
        }



        $total_welder = Welder::count();
        $total_berita = Berita::count();
        return view('dashboard.index')->with(compact('total_welder', 'total_berita', 'chartLabels', 'chartData'));
    }

    public function grafis(){
        $startDate = Carbon::now()->subWeek(); // Tanggal mulai satu minggu yang lalu
        $endDate = Carbon::now(); // Tanggal sekarang
        $grafis = DB::table('logs')
                        ->select(DB::raw('DATE(created_at) as visit_date'), DB::raw('COUNT(*) as record_count'))
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->whereTime('created_at', '>=', '00:00:00')
                        ->whereTime('created_at', '<=', '23:59:59')
                        ->groupBy('visit_date')
                        ->orderBy('visit_date', 'asc')
                        ->get();
        return $grafis;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
