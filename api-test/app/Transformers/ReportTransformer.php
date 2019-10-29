<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Report;

class ReportTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Report $report)
    {
        return [
            'foto_laporan' => $report->foto_laporan,
            'judul_laporan' => $report->judul_laporan,
            'isi_laporan' => $report->isi_laporan,
            'lokasi_latitude' => $report->lat,
            'lokasi_longitude' => $report->lon,
            'status_laporan' => $report->status_laporan,
            'tanggal_dibuat' => $report->created_at
        ];
    }
}
