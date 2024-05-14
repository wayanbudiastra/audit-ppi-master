<?php

namespace App\Models\Master;

use App\Models\Setting\Tahun;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $table = 'periode';
    protected $guarded = [];


    public function tahun()
    {
        return $this->belongsTo(Tahun::class);
    }
}