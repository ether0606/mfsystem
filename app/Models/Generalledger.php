<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generalledger extends Model
{
    use HasFactory;
    public function master_head(){
        return $this->belongsTo('App\Models\Masterhead','masterhead_id','id');
    }
    public function sub_head(){
        return $this->belongsTo('App\Models\Subhead','subhead_id','id');
    }
    public function chield_one(){
        return $this->belongsTo('App\Models\Chieldheadone','chieldheadone_id','id');
    }
    public function chield_two(){
        return $this->belongsTo('App\Models\Chieldheadtwo','chieldheadtwo_id','id');
    }
}
