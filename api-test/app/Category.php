<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'kategori';

    protected $primaryKey = 'id_kategori';

    public function report()
    {
        return $this->hasMany('App\Report');
    }
}
