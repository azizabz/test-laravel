<?php

namespace App\Http\Controllers;

use App\Report;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reports/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto_laporan' => 'required|nullable|max:1999',
            'jdl_lpr' => 'required',
            'isi_lpr' => 'required',
            'kategori' => 'required',
            'pelapor' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        //File Upload
        if ($request->hasFile('foto_laporan')) {
            //filename + extension
            $filenameWithExt = $request->file('foto_laporan')->getClientOriginalName();
            //filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //extension
            $extension = $request->file('foto_laporan')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('foto_laporan')->storeAs('public/foto_laporan', $fileNameToStore);
        }

        $report = new Report;
        if ($request->hasFile('foto_laporan')) {
        Storage::delete('public/foto_laporan/' . $report->foto_laporan);
        $report->foto_laporan = $fileNameToStore;
        }
        $report->judul_laporan = $request->jdl_lpr;
        $report->isi_laporan = $request->isi_lpr;
        $report->id_kategori = $request->kategori;
        $report->user_id = auth()->user()->id;
        $report->status_pelapor = $request->pelapor;
        $report->lat = substr($request->lat,0,17);
        $report->lon = substr($request->lng,0,16);
        $report->status_laporan = 'lapor';
        $report->tgl_kirim = date('Y-m-d');

        $report->save();

        return redirect('/')->with('success', 'Laporan berhasil kirim!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        return view('reports/detail', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        return view('reports/edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        $request->validate([
            'jdl_lpr' => 'required',
            'isi_lpr' => 'required',
            'kategori' => 'required',
            'pelapor' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        //File Upload
        if ($request->hasFile('foto_laporan')) {
            //filename + extension
            $filenameWithExt = $request->file('foto_laporan')->getClientOriginalName();
            //filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //extension
            $extension = $request->file('foto_laporan')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('foto_laporan')->storeAs('public/foto_laporan', $fileNameToStore);
        }

        $report = Report::find($report->id);
        if ($request->hasFile('foto_laporan')) {
        $report->foto_laporan = $fileNameToStore;
        }
        $report->judul_laporan = $request->jdl_lpr;
        $report->isi_laporan = $request->isi_lpr;
        $report->id_kategori = $request->kategori;
        $report->user_id = auth()->user()->id;
        $report->status_pelapor = $request->pelapor;
        $report->lat = substr($request->lat,0,17);
        $report->lon = substr($request->lng,0,16);
        $report->status_laporan = 'lapor';
        $report->tgl_kirim = date('Y-m-d');

        $report->save();

        return redirect('/')->with('success', 'Laporan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        if ($report->foto_laporan != 'noimage.jpg') {
            Storage::delete('public/foto_laporan/'.$report->foto_laporan);
        }
        Report::destroy($report->id);
        return redirect('/')->with('success', 'Data laporan berhasil dihapus!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function log()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $reports = $user->reports;
        $reports = Report::paginate(5);

        return view('reports/log')->with('reports', $reports);
    }
}
