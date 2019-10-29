<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'foto_laporan', 'judul_laporan', 'isi_laporan', 'id_kategori', 'user_id', 'status_pelapor', 'lokasi_latitude', 'lokasi_longitude', 'status_laporan', 'tgl_kirim',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
