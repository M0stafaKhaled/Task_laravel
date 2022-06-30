<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {

        return view('admin.home');

    }// end of index

    public function topStatistics()
    {



    }// end of topStatistics

    public function moviesChart()
    {
        $movies = Movie::whereYear('release_date', request()->year)
            ->select(
                '*',
                DB::raw('MONTH(release_date) as month'),
                DB::raw('YEAR(release_date) as year'),
                DB::raw('COUNT(id) as total_movies'),
            )
            ->groupBy('month')
            ->get();

        return view('admin._movies_chart', compact('movies'));

    }// end of moviesChart

}//end of controller
