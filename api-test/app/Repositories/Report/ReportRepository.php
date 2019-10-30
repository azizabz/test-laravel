<?php
namespace App\Repositories\Report;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repositories\Report\ReportInterface as ReportInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Transformers\ReportTransformer;

use App\Report;
use App\User;

class ReportRepository implements ReportInterface
{
    private $fractal;
    protected $report;
    protected $user;

	public function __construct(Manager $fractal, ReportTransformer $reportTransformer, Report $report, User $user)
	{
        $this->fractal = $fractal;
        $this->reportTransformer = $reportTransformer;
        $this->report = $report;
        $this->user = $user;
    }

    public function findReportById($id)
    {
        try {
            $report = Report::findOrFail($id);
            $report = new Item($report, $this->reportTransformer);
            $report = $this->fractal->createData($report);

            return $report->toArray();
                
        } catch (\Exception $e) {

            return response()->json(['message' => 'Report not found!'], 404);
        }
    }

    public function getAllPagination($page)
    {
        $reportsPaginator = Report::orderBy('id', 'DESC')->get();
        $reportsPaginator = Report::paginate($page);
        $reports = new Collection($reportsPaginator->items(), $this->reportTransformer);
        $reports->setPaginator(new IlluminatePaginatorAdapter($reportsPaginator));
        $reports = $this->fractal->createData($reports);

        return $reports->toArray();
        
    }

    public function findMyReports($page)
    {
        try{
        $user = User::find(Auth::user()->id);
        $reportsPaginator = $user->reports;
        $reportsPaginator = Report::paginate($page)->orderBy('id', 'desc');
        $reports = new Collection($reportsPaginator->items(), $this->reportTransformer);
        $reports->setPaginator(new IlluminatePaginatorAdapter($reportsPaginator));
        $reports = $this->fractal->createData($reports);

        return $reports->toArray();
        
        } catch (\Exception $e) {

        return response()->json(['message' => 'You have not made a report yet!'], 404);
        
        }
    }

    public function createReport(Request $request)
    {
        $user = Auth::user()->id;
        $report = Report::create([
    		'foto_laporan' => $request->foto_laporan,
            'judul_laporan' => $request->judul_laporan,
            'isi_laporan' => $request->isi_laporan,
            'id_kategori' => $request->id_kategori,
            'user_id' => $user,
            'status_pelapor' => $request->status_pelapor,
            'lat' => $request->lat,
            'lon' => $request->lon,
            'status_laporan' => 'lapor',
            'tgl_kirim' => date('Y-m-d')
        ]);
        
        $report = new Item($report, $this->reportTransformer);
        $report = $this->fractal->createData($report);

        return $report->toArray();

    }

    public function editReport(Request $request, $id)
    {
        try {
        $user = Auth::user()->id;
        $report = Report::where('id', $id)->first();
        $report->foto_laporan = $request->foto_laporan;
        $report->judul_laporan = $request->judul_laporan;
        $report->isi_laporan = $request->isi_laporan;
        $report->id_kategori = $request->id_kategori;
        $report->user_id = $user;
        $report->status_pelapor = $request->status_pelapor;
        $report->lat = substr($request->lat,0,17);
        $report->lon = substr($request->lon,0,16);
        $report->status_laporan = 'lapor';
        $report->tgl_kirim = date('Y-m-d');

        $report->save();

        $report = new Item($report, $this->reportTransformer);
        $report = $this->fractal->createData($report);

        return $report->toArray();

        } catch (\Exception $e) {

        return response()->json(['message' => 'Report not found!'], 404);
    
        }
    }

    public function deleteReport($id)
    {
        try{
        $report = Report::where('id', $id)->first();
        $report->delete();

        return response()->json(['message' => 'Report deleted successfully!'], 200);
        
        } catch (\Exception $e) {

        return response()->json(['message' => 'Report not found!'], 404);
    
        }
    }
}