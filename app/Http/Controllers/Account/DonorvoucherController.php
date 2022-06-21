<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

use App\Models\Donorvoucher;
use App\Models\Donorvoucherbkdn;
use App\Models\Generalledger;
use App\Models\Generalvoucher;

use App\Models\Chieldheadone;

use App\Models\Patientfund;
use App\Models\Patient;
use App\Models\Donor;
use App\Models\Donorfund;

use Illuminate\Http\Request;

use App\Http\Traits\ResponseTrait;
use Exception;

use DB;

class DonorvoucherController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $donorvoucher=Donorvoucher::latest()->paginate(15);
        return view('accounts.donor_voucher.index',compact('donorvoucher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $patients=Patient::where('status',1)->get();
        $donors=Donor::where('status',1)->get();
        $expense=Chieldheadone::whereIn('id',[34,35,36])->where('company_id',company())->get();
        return view('accounts.donor_voucher.create',compact('patients','donors','expense'));
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
				$sub2Arr = DB::select("SELECT * FROM chieldheadones WHERE company_id = {$company_id} and subhead_id = {$sub1_row->id} ORDER BY id ASC");
				if ($sub2Arr){
					foreach ($sub2Arr as $sub2_row){
					    if($sub1_row->id==1 || $sub1_row->id==2){
					        $fcoa_bkdnArr["{$sub2_row->id}"]=array(
															"id"=>$sub2_row->id,
															"parent"=>$sub1_row->id,
															"head"=>$sub2_row->head_name,
															"coa_code"=>$sub2_row->chieldone_code,
															"lavel"=>"chieldheadones"
															);
					        $sub3Arr = DB::select("SELECT * FROM chieldheadtwos WHERE company_id = {$company_id} and chieldheadone_id = {$sub2_row->id} ORDER BY id ASC");
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
					    }else{/*nothing will get*/}
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
		if (is_array($array)){	
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
	
    public function create_voucher_no(){
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
                $jv=new Donorvoucher;
                $jv->voucher_no=$voucher_no;
                $jv->v_date=$request->v_date;
                $jv->particular=$request->particular;
                $jv->credit_sum=$request->debit_sum;
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
                            $jvb=new Donorvoucherbkdn;
                            $jvb->donorvoucher_id=$jv->id;
                            $jvb->remarks=!empty($request->remarks[$i])?$request->remarks[$i]:"";
                            $jvb->account_code=!empty($acccode)?$acccode:"";
                            $jvb->table_name=!empty($request->table_name[$i])?$request->table_name[$i]:"";
                            $jvb->table_id=!empty($request->table_id[$i])?$request->table_id[$i]:"";
                            $jvb->debit=!empty($request->debit[$i])?$request->debit[$i]:0;
                            if($jvb->save()){
                                $table_name=$request->table_name[$i];
                                if($table_name=="masterheads"){$field_name="masterhead_id";}
    							else if($table_name=="subheads"){$field_name="subhead_id";}
    							else if($table_name=="chieldheadones"){$field_name="chieldheadone_id";}
    							else if($table_name=="chieldheadtwos"){$field_name="chieldheadtwo_id";}
    							$gl=new Generalledger;
                                $gl->journal_title=!empty($request->remarks[$i])?$request->remarks[$i]:$request->particular;
                                $gl->v_date=$request->v_date;
                                $gl->jv_id=$voucher_no;
                                $gl->created_by=currentUserId();
                                $gl->company_id=company();
                                $gl->dr=!empty($request->debit[$i])?$request->debit[$i]:0;
                                $gl->{$field_name}=!empty($request->table_id[$i])?$request->table_id[$i]:"";
                                $gl->save();
                            }
                        }
                    
                        $credit=array('chieldheadones',28,'41001-Donor');
                        $jvb=new Donorvoucherbkdn;
                        $jvb->donorvoucher_id=$jv->id;
                        $jvb->remarks="Received for ".explode('~',$request->recfor)[2];
                        $jvb->account_code=$credit[2];
                        $jvb->table_name=$credit[0];
                        $jvb->table_id=$credit[1];
                        $jvb->credit=$request->debit_sum;
                        if($jvb->save()){
                            $table_name=$credit[0];
                            if($table_name=="masterheads"){$field_name="masterhead_id";}
							else if($table_name=="subheads"){$field_name="subhead_id";}
							else if($table_name=="chieldheadones"){$field_name="chieldheadone_id";}
							else if($table_name=="chieldheadtwos"){$field_name="chieldheadtwo_id";}
							$gl=new Generalledger;
                            $gl->journal_title="Received for ".explode('~',$request->recfor)[2];
                            $gl->v_date=$request->v_date;
                            $gl->jv_id=$voucher_no;
                            $gl->created_by=currentUserId();
                            $gl->company_id=company();
                            $gl->cr=$request->debit_sum;
                            $gl->{$field_name}=$credit[1];
                            $gl->save();
                        }
                    }

					$donorf=new Donorfund;
					$donorf->jv_id=$voucher_no;
					if(explode('~',$request->recfor)[1]==34)
						$donorf->fund_type=1;
					elseif(explode('~',$request->recfor)[1]==35)
						$donorf->fund_type=2;
					else
						$donorf->fund_type=3;
					$donorf->donor_id=$request->donor;
					$donorf->amount=$request->debit_sum;
					$donorf->note=$request->particular;
					$donorf->save();
					
					if($request->patient){
						$patients=new Patientfund;
						$patients->jv_id=$voucher_no;
						$patients->patient_id=$request->patient;
						$patients->donor_id=$request->donor;
						$patients->amount=$request->debit_sum;
						$patients->note=$request->particular;
						$patients->save();
					}
                }
                DB::commit();
				return redirect(route(currentUser().'.donorvoucher.index'))->with($this->responseMessage(true, null, 'Voucher created'));
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
     * @param  \App\Models\Donorvoucher  $debitvoucher
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$donorvoucher=Donorvoucher::find($id);
		$donorbkdn=Donorvoucherbkdn::where('donorvoucher_id',$id)->get();
		$donor_fund=Donorfund::where('jv_id',$donorvoucher->voucher_no)->first();
		$patient_fund=array();
		$patient=array();
		if($donor_fund->fund_type==1){
			$patient_fund=Patientfund::where('jv_id',$donorvoucher->voucher_no)->first();
			$patient=Patient::where('id',$patient_fund->patient_id)->first();
		}
		$donor=Donor::where('id',$donor_fund->donor_id)->first();
        return view('accounts.donor_voucher.show',compact('donorvoucher','donorbkdn','donor_fund','patient_fund','patient','donor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donorvoucher  $debitvoucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Donorvoucher $debitvoucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donorvoucher  $debitvoucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donorvoucher $debitvoucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donorvoucher  $debitvoucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donorvoucher $debitvoucher)
    {
        //
    }
}
