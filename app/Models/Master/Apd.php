<?php

namespace App\Models\Master;

use App\Models\Setting\Ruangan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apd extends Model
{
    use HasFactory;
    protected $table = 'apd';
    protected $guarded = [];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}