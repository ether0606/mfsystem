<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

use App\Models\Journalvoucher;
use App\Models\Journalvoucherbkdn;
use App\Models\Generalledger;
use App\Models\Generalvoucher;
use Illuminate\Http\Request;

use App\Http\Traits\ResponseTrait;
use Exception;

use DB;

class JournalvoucherController extends Controller{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $journal=Journalvoucher::latest()->paginate(15);
        return view('accounts.journal_voucher.index',compact('journal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('accounts.journal_voucher.create');
    }
    
    public function get_head(Request $request){
        
        $row='';
		$needle = $request->code;
		$needle = strtolower($needle);
		
		$company_id=1;
		
		$master_headArr=array();
		$fcoaArr=array();
		$fcoa_bkdnArr=array();
		$sub_fcoa_bkdnArr=array();
		
		$master = DB::select("SELECT * FROM masterheads WHERE company_id = $company_id ORDER BY id ASC");
		if ($master){
			foreach ($master as $master_row){
			$master_headArr["{$master_row->id}"]=array(
													"id"=>$master_row->id,
													"parent"=>"",
													"head"=>$master_row->head_name,
													"coa_code"=>$master_row->head_code,
													"lavel"=>"masterheads"
												);
				
					
			$sub1Arr = DB::select("SELECT * FROM subheads WHERE company_id = {$company_id} 
			                        and masterhead_id = {$master_row->id} ORDER BY id ASC");
			if ($sub1Arr){
				foreach ($sub1Arr as $sub1_row){
				    $fcoaArr["{$sub1_row->id}"]=array(
														"id"=>$sub1_row->id,
														"parent"=>$master_row->id,
														"head"=>$sub1_row->head_name,
														"coa_code"=>$sub1_row->subhead_code,
														"lavel"=>"subheads"
													);
				$sub2Arr = DB::select("SELECT * FROM chieldheadones WHERE company_id = {$company_id} 
												and subhead_id = {$sub1_row->id}
												ORDER BY id ASC");
				if ($sub2Arr){
					foreach ($sub2Arr as $sub2_row){
					$fcoa_bkdnArr["{$sub2_row->id}"]=array(
															"id"=>$sub2_row->id,
															"parent"=>$sub1_row->id,
															"head"=>$sub2_row->head_name,
															"coa_code"=>$sub2_row->chieldone_code,
															"lavel"=>"chieldheadones"
															);
		
					$sub3Arr = DB::select("SELECT * FROM chieldheadtwos WHERE company_id = {$company_id} 
											and chieldheadone_id = {$sub2_row->id} ORDER BY id ASC");
					if ($sub3Arr){
						foreach ($sub3Arr as $sub3_row){
						  $sub_fcoa_bkdnArr["{$sub3_row->id}"]=array(
																"id"=>$sub3_row->id,
																"parent"=>$sub2_row->id,
																"head"=>$sub3_row->head_name,
																"coa_code"=>$sub3_row->chieldtwo_code,
																"lavel"=>"chieldheadtwos"
															);
						}
					}
				    }
				}
				}
			}
			}
		}
		
		
		$masterSingleArr=array();
		$fcoaSingleArr=array();
		$fcoa_bkdnSingleArr=array();
		$sub_fcoa_bkdnSingleArr=array();
		
		if(sizeof($master_headArr)>0){
			foreach($master_headArr as $masterheadArr){
				
				$masterhead_coa_id 	= $masterheadArr["id"];
				$masterhead_coa 	= $masterheadArr["head"];
				$coa_code			= $masterheadArr["coa_code"];
				$lavel				= $masterheadArr["lavel"];
				
				$result=$this->search_array_key($fcoaArr,'parent',$masterhead_coa_id);
				
				if(sizeof($result)<=0){
					$masterSingleArr[]=$coa_code."-".$masterhead_coa."-".$lavel."-".$masterhead_coa_id;
				}	
			}
		}
		
		
		if(sizeof($fcoaArr)>0){
			foreach($fcoaArr as $fcoa_Arr){
				
				$fcoa_id 	= $fcoa_Arr["id"];
				$fcoa_head 	= $fcoa_Arr["head"];
				$coa_code	= $fcoa_Arr["coa_code"];
				$lavel		= $fcoa_Arr["lavel"];
				
				$result=$this->search_array_key($fcoa_bkdnArr,'parent',$fcoa_id);
				if(sizeof($result)<=0){
					$fcoaSingleArr[]=$coa_code."-".$fcoa_head."-".$lavel."-".$fcoa_id;
				}	
			}
		}
		
		if(sizeof($fcoa_bkdnArr)>0){
			foreach($fcoa_bkdnArr as $fcoabkdnArr){
				
				$fcoa_bkdn_id 	= $fcoabkdnArr["id"];
				$fcoa_bkdn 		= $fcoabkdnArr["head"];
				$coa_code		= $fcoabkdnArr["coa_code"];
				$lavel			= $fcoabkdnArr["lavel"];
				
				$result=$this->search_array_key($sub_fcoa_bkdnArr,'parent',$fcoa_bkdn_id);
				if(sizeof($result)<=0){
					$fcoa_bkdnSingleArr[]=$coa_code."-".$fcoa_bkdn."-".$lavel."-".$fcoa_bkdn_id;
				}	
			}
		}
		
		if(sizeof($sub_fcoa_bkdnArr)>0){
			foreach($sub_fcoa_bkdnArr as $subfcoabkdnArr){
				
				$sub_fcoa_bkdn_id 	= $subfcoabkdnArr["id"];
				$sub_fcoa_bkdn 		= $subfcoabkdnArr["head"];
				$coa_code			= $subfcoabkdnArr["coa_code"];
				$lavel				= $subfcoabkdnArr["lavel"];
				
				/*$result=$this->search_array_key($coa_subArr,'parent',$sub_fcoa_bkdn_id);
				if(sizeof($result)<=0){*/
					$sub_fcoa_bkdnSingleArr[]=$coa_code."-".$sub_fcoa_bkdn."-".$lavel."-".$sub_fcoa_bkdn_id;
				//}	
			}
		}
		
	
		$FinalResult = array_merge($masterSingleArr, $fcoaSingleArr);
		$FinalResult = array_merge($FinalResult, $fcoa_bkdnSingleArr);
		$FinalResult = array_merge($FinalResult, $sub_fcoa_bkdnSingleArr);
		
		
		$FinalResultBuild=array();
		$FinalResultTmp=array();
		$FinalResultTmp = $FinalResult;
		foreach($FinalResultTmp as $FinalResultStr){
			$coacode='';
			$coaname='';
			$FinalResultARR=explode("-",$FinalResultStr);
			$coacode=$FinalResultARR[0];
			$coaname=$FinalResultARR[1];
			$FinalResultBuild[]= $coacode."-".$coaname;	
		}
		
		$StrToLowerFRES=array();
		foreach($FinalResult as $StrToLower){
			$StrToLowerFRES[]= strtolower($StrToLower);	
		}
		
		$StrToLowerRes=array();
		foreach($FinalResultBuild as $StrToLower){
			$StrToLowerRes[]= strtolower($StrToLower);	
		}
		
		
		$ret=array();
		$ret = array_values(array_filter($StrToLowerRes, function($var) use ($needle){
			return strpos($var, $needle) !== false;
		}));
		
		
		$res=array();
		foreach($ret as $retstr){
			$res[] = array_values(array_filter($StrToLowerFRES, function($var) use ($retstr){
				return strpos($var, $retstr) !== false;
			}));
		}
		
		
		$resss=array();
		$resss = $this->array_flatten($res);
		
		if(sizeof($resss)>0){
			foreach($resss as $ret_value){
				$ret_valueArr=explode("-",$ret_value);
				$codenumber = $ret_valueArr[0];
				$head 		= ucwords($ret_valueArr[1]);
				$tableName 	= $ret_valueArr[2];
				$tableId 	= $ret_valueArr[3];
				
				$display_value = $codenumber."-".$head;
				
				if(!empty($tableName) && !empty($tableId)){
					$list_array[] = array('table_name'=>$tableName,'table_id'=>$tableId,'display_value'=>$display_value);
				}
			}
		}
		print json_encode($list_array);
    }
    
    public function search_array_key($array, $key, $value){
		$results = array();
		if (is_array($array))
		{	
			if (isset($array[$key]) && $array[$key] == $value){
				$results[] = $array;
			}
			foreach ($array as $subarray){
				$results = array_merge($results, $this->search_array_key($subarray, $key, $value));
			}
		}		
		return $results;
	}
	
	public function array_flatten($array){
		$return = array();
		array_walk_recursive($array, function($x) use (&$return) { $return[] = $x; });
		return $return;
	}
	
    function create_voucher_no(){
		$voucher_no="";
		$query = Generalvoucher::where('company_id',company())->latest()->first();
		if(!empty($query)){
		    $voucher_no = $query->voucher_no;
			$voucher_no+=1;
			$gv=new Generalvoucher;
			$gv->voucher_no=$voucher_no;
			$gv->company_id=company();
			if($gv->save())
				return $voucher_no;
			else
				return $voucher_no="";
		}else {
			$voucher_no=10000001;
			$gv=new Generalvoucher;
			$gv->voucher_no=$voucher_no;
			$gv->company_id=company();
			if($gv->save())
				return $voucher_no;
			else
				return $voucher_no="";
		}
    }
    
    public function store(Request $request){
        try {
            DB::beginTransaction();
            $voucher_no = $this->create_voucher_no();
            if(!empty($voucher_no)){
                $jv=new Journalvoucher;
                $jv->voucher_no=$voucher_no;
                $jv->v_date=$request->v_date;
                $jv->particular=$request->particular;
                $jv->credit_sum=$request->credit_sum;
                $jv->debit_sum=$request->debit_sum;
                $jv->cheque_no=$request->cheque_no;
                $jv->bank_name=$request->bank_name;
                $jv->cheque_date=$request->cheque_date;
                $jv->created_by=currentUserId();
                $jv->company_id=company();
                if($jv->save()){
                    $account_codes=$request->account_code;
                    $table_id=$request->table_id;
                    $credit=$request->credit;
                    $debit=$request->debit;
                    if(sizeof($account_codes)>0){
                        foreach($account_codes as $i=>$acccode){
                            $jvb=new Journalvoucherbkdn;
                            $jvb->journalvoucher_id=$jv->id;
                            $jvb->remarks=!empty($request->remarks[$i])?$request->remarks[$i]:"";
                            $jvb->account_code=!empty($acccode)?$acccode:"";
                            $jvb->table_name=!empty($request->table_name[$i])?$request->table_name[$i]:"";
                            $jvb->table_id=!empty($request->table_id[$i])?$request->table_id[$i]:"";
                            $jvb->debit=!empty($request->debit[$i])?$request->debit[$i]:0;
                            $jvb->credit=!empty($request->credit[$i])?$request->credit[$i]:0;
                            if($jvb->save()){
                                $table_name=$request->table_name[$i];
                                if($table_name=="masterheads"){$field_name="masterhead_id";}
    							else if($table_name=="subheads"){$field_name="subhead_id";}
    							else if($table_name=="chieldheadones"){$field_name="chieldheadone_id";}
    							else if($table_name=="chieldheadtwos"){$field_name="chieldheadtwo_id";}
    							$gl=new Generalledger;
                                $gl->journalvoucher_id=$jv->id;
                                $gl->journal_title=!empty($request->remarks[$i])?$request->remarks[$i]:$request->particular;
                                $gl->v_date=$request->v_date;
                                $gl->jv_id=$voucher_no;
                                $gl->journalvoucherbkdn_id=$jvb->id;
                                $gl->created_by=currentUserId();
                                $gl->company_id=company();
                                $gl->dr=!empty($request->debit[$i])?$request->debit[$i]:0;
                                $gl->cr=!empty($request->credit[$i])?$request->credit[$i]:0;
                                $gl->{$field_name}=!empty($request->table_id[$i])?$request->table_id[$i]:"";
                                $gl->save();
    							
                            }
                        }
                    }
                }
                DB::commit();
				return redirect(route(currentUser().'.journal.index'))->with($this->responseMessage(true, null, 'Voucher created'));
			}else{
				return redirect()->back()->with($this->responseMessage(false, 'error', 'Please try again!'));
			}
		}catch (Exception $e) {
			dd($e);
			DB::rollBack();
			return redirect()->back()->with($this->responseMessage(false, 'error', 'Please try again!'));
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Journalvoucher  $journalvoucher
     * @return \Illuminate\Http\Response
     */
    public function show(Journalvoucher $journalvoucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Journalvoucher  $journalvoucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Journalvoucher $journalvoucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Journalvoucher  $journalvoucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Journalvoucher $journalvoucher){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Journalvoucher  $journalvoucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Journalvoucher $journalvoucher)
    {
        //
    }
}
