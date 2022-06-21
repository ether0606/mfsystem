<?php

namespace App\Http\Controllers\Account\Report;

use App\Http\Controllers\Controller;

use App\Models\Chieldheadtwo;
use App\Models\Chieldheadone;
use App\Models\Subhead;
use App\Models\Masterhead;

use App\Models\Generalledger;

use Illuminate\Http\Request;

use DB;

class HeadReportController extends Controller{
    public function index(Request $r){
        
        $headlists=Generalledger::groupBy(['masterhead_id','subhead_id','chieldheadone_id','chieldheadtwo_id'])->get();
        
        $startDate=$endDate="";
        
        if($r->current_date){
            $current_date=explode(' / ',$r->current_date);
            $startDate=date('Y-m-d',strtotime($current_date[0]));
            $endDate=date('Y-m-d',strtotime($current_date[1]));
        }
        $opening_bal=$head_id=$table_id_name=0;
        $accData=$accOldData=array();
        if($r->head_id){
            $head_id=explode('-',$r->head_id);
            $opening_bal=$head_id[2];
            $table_id_name=$head_id[1];
            $head_id=$head_id[0];
        }
        if($head_id){
            $accOldData=Generalledger::where('v_date', '<',$startDate)->where($table_id_name,$head_id)->get();
            $accData=Generalledger::whereBetween('v_date', [$startDate, $endDate])->where($table_id_name,$head_id)->get();
            
        }
	//print_r($accData);
	//die();
        return view("accounts.report.headreport",compact("headlists","accOldData","accData","opening_bal","startDate","endDate"));
    }
}