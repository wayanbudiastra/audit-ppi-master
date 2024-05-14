<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hand_hygiene_detail extends Model
{
    use HasFactory;
    protected $table = 'hand_hygiene_detail';
    protected $guarded = [];

    public function hand_hygiene()
    {
        return $this->belongsTo(Hand_hygiene::class);
    }
}