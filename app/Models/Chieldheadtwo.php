<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chieldheadtwo extends Model
{
    use HasFactory;
    public function chield_one(){
        return $this->belongsTo('App\Models\Chieldheadone','chieldheadone_id','id');
    }
}
