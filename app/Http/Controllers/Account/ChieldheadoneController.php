<?php


namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

use App\Models\Chieldheadone;
use App\Models\Subhead;
use Illuminate\Http\Request;
use App\Http\Requests\Chieldone\AddNewRequest;

use App\Http\Traits\ResponseTrait;
use Exception;

class ChieldheadoneController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chieldhead=Chieldheadone::paginate(10);
        $sub_head=Subhead::get();
		return view('accounts.chield_head_one.index',compact('chieldhead','sub_head'));
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
                $chieldone=Chieldheadone::findOrFail($r->id);
            else
                $chieldone=new Chieldheadone;
            
            $chieldone->subhead_id=$r->subhead_id;
            $chieldone->head_name=$r->head_name;
            $chieldone->chieldone_code=$r->chieldone_code;
            $chieldone->opening_balance=$r->opening_balance;
            
            if(!!$chieldone->save()){
                return redirect(route('chieldone.index'))->with($this->responseMessage(true,null,"Data successfully created."));
            }
        }catch(Exception $e){
			dd($e);
            return redirect(route('subhead.create'))->with($this->responseMessage(false,"error","Please try again!"));
        }
    }

}
