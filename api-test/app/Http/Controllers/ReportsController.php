<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use App\Repositories\Report\ReportInterface as ReportInterface;

class ReportsController extends Controller
{
    private $reportRepository;

    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct(ReportInterface $reportRepository)
    {
        $this->middleware('auth');

        $this->reportRepository = $reportRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->reportRepository->getAllPagination(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->reportRepository->createReport($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->reportRepository->findReportById($id);
    }

    public function myreport()
    {
        return $this->reportRepository->findMyReports(5);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->reportRepository->editReport($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->reportRepository->deleteReport($id);
    }
}
