<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chieldheadone extends Model
{
    use HasFactory;
    public function sub_head(){
        return $this->belongsTo('App\Models\Subhead','subhead_id','id');
    }
}