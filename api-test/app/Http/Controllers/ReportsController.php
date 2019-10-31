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
        $reports = $this->reportRepository->getAllPagination(5);

        return $this->responseSuccess($reports);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $createReport = $this->reportRepository->createReport($request);

        return $this->responseSuccess($createReport);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = $this->reportRepository->findReportById($id);

        return $this->responseSuccess($report);
    }

    public function myreports()
    {
        $myReports = $this->reportRepository->findMyReports(5);

        return $this->responseSuccess($myReports);
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
        $editReport = $this->reportRepository->editReport($request, $id);

        return $this->responseSuccess($editReport);
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
