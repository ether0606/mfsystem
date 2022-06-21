<?php


namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

use App\Models\Masterhead;
use Illuminate\Http\Request;
use App\Http\Requests\Masterhead\AddNewRequest;

use App\Http\Traits\ResponseTrait;
use Exception;

class MasterheadController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masterhead=Masterhead::paginate(10);
		return view('accounts.master_head.index',compact('masterhead'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                $mhead=Masterhead::findOrFail($r->id);
            else
                $mhead=new Masterhead;
                
            $mhead->head_name=$r->head_name;
            $mhead->head_code=$r->head_code;
            
            if(!!$mhead->save()){
                return redirect(route('masterhead.index'))->with($this->responseMessage(true,null,"Data successfully created."));
            }
        }catch(Exception $e){
			dd($e);
            return redirect(route('masterhead.create'))->with($this->responseMessage(false,"error","Please try again!"));
        }
    }

}
