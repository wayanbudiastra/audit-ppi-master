<?php

namespace App\Models\Master;

use App\Models\Setting\Profesi;
use App\Models\Setting\Ruangan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hand_hygiene extends Model
{
    use HasFactory;
    protected $table = 'hand_hygiene';
    protected $guarded = [];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function opportunity()
    {
        $data = Hand_hygiene_detail::where('hand_hygiene_id', $this->id)->max('opportunity');
        return $data;
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function profesi(){
        return $this->belongsTo(Profesi::class);
    }
}