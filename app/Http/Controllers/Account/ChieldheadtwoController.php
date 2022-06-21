<?php


namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

use App\Models\Chieldheadtwo;
use App\Models\Chieldheadone;
use Illuminate\Http\Request;
use App\Http\Requests\Chieldtwo\AddNewRequest;

use App\Http\Traits\ResponseTrait;
use Exception;

class ChieldheadtwoController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chieldtwo=Chieldheadtwo::paginate(10);
        $chield_one=Chieldheadone::get();
		return view('accounts.chield_head_two.index',compact('chieldtwo','chield_one'));
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
                $chieldtwo=Chieldheadtwo::findOrFail($r->id);
            else
                $chieldtwo=new Chieldheadtwo;
                
            $chieldtwo->chieldheadone_id=$r->chieldheadone_id;
            $chieldtwo->head_name=$r->head_name;
            $chieldtwo->chieldtwo_code=$r->chieldtwo_code;
            $chieldtwo->opening_balance=$r->opening_balance;
            
            if(!!$chieldtwo->save()){
                return redirect(route('chieldtwo.index'))->with($this->responseMessage(true,null,"Data successfully created."));
            }
        }catch(Exception $e){
			dd($e);
            return redirect(route('chieldtwo.create'))->with($this->responseMessage(false,"error","Please try again!"));
        }
    }

}
