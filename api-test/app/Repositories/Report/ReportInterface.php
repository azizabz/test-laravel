<?php

namespace App\Repositories\Report;
use Illuminate\Http\Request;
use App\Report;

interface ReportInterface {
    public function findReportById($id);
    public function findMyReports($page);
    public function getAllPagination($page);
    public function createReport(Request $request);
    public function editReport(Request $request, $id);
    public function deleteReport($id);
}