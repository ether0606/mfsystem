<?php


namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

use App\Models\Subhead;
use App\Models\Masterhead;
use Illuminate\Http\Request;
use App\Http\Requests\Subhead\AddNewRequest;

use App\Http\Traits\ResponseTrait;
use Exception;

class SubheadController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subhead=Subhead::paginate(10);
        $masterhead=Masterhead::get();
		return view('accounts.sub_head.index',compact('subhead','masterhead'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddNewRequest $r)
    {
        try{
            if($r->id > 0)
                $subhead=Subhead::findOrFail($r->id);
            else
                $subhead=new Subhead;
            
            $subhead->masterhead_id=$r->masterhead_id;
            $subhead->head_name=$r->head_name;
            $subhead->subhead_code=$r->subhead_code;
            $subhead->opening_balance=$r->opening_balance;
            
            if(!!$subhead->save()){
                return redirect(route('subhead.index'))->with($this->responseMessage(true,null,"Data successfully created."));
            }
        }catch(Exception $e){
			dd($e);
            return redirect(route('subhead.create'))->with($this->responseMessage(false,"error","Please try again!"));
        }
    }
}
