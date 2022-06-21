<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subhead extends Model
{
    use HasFactory;
    public function master_head(){
        return $this->belongsTo('App\Models\Masterhead','masterhead_id','id');
    }
}
