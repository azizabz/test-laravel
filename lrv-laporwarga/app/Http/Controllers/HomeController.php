<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $reports = DB::table('reports')->get();
        $announces = DB::table('announces')->get();
        return view('index', ['reports' => $reports, 'announces' => $announces]);
    }
}
