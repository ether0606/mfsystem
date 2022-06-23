<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

use App\Http\Requests\Patient\UpdateRequest;
use App\Http\Requests\Patient\CreateRequest;

use App\Http\Traits\ResponseTrait;
use App\Http\Traits\ImageHandleTraits;

use Exception;

class PatientController extends Controller
{
    use ResponseTrait,ImageHandleTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients=Patient::latest()->paginate(10);
        return view('patient.index',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        try{
            $patient=new Patient;
            $patient->name=$request->name;
            $patient->patient_occupation=$request->patient_occupation;
            $patient->father=$request->father;
            $patient->father_occupation=$request->father_occupation;
            $patient->mother=$request->mother;
            $patient->mother_occupation=$request->mother_occupation;
            $patient->disease_name=$request->disease_name;
            $patient->age=$request->age;
            $patient->disease_description=$request->disease_description;
            $patient->hospital_name=$request->hospital_name;
            $patient->doctor_name=$request->doctor_name;
            $patient->spouse_name=$request->spouse_name;
            $patient->marital_status=$request->marital_status;
            $patient->treatment_cost=$request->treatment_cost;
            $patient->apply_amount=$request->apply_amount;
            $patient->contact=$request->contact;
            $patient->alt_contact=$request->alt_contact;
            $patient->family_member=$request->family_member;
            $patient->present_address=$request->present_address;
            $patient->permanent_address=$request->permanent_address;
            $patient->nid_birthid=$request->nid_birthid;
            if($request->has('photo')) $patient->photo = $this->uploadImage($request->file('photo'), 'patient_photo');
            if($request->has('pdf_documents')) $patient->pdf_documents = $this->uploadImage($request->file('pdf_documents'), 'patient_document');
            if($request->has('id_card_font')) $patient->id_card_font = $this->uploadImage($request->file('id_card_font'), 'patient_id_card');
            if($request->has('id_card_back')) $patient->id_card_back = $this->uploadImage($request->file('id_card_back'), 'patient_id_card');
            $patient->status=$request->status;
            if(!!$patient->save()){
                return redirect(route(currentUser().'.patient.index'))->with($this->responseMessage(true,null,"user successfully created."));
            }
        }catch(Exception $e){
            dd($e);
            return redirect()->back()->with($this->responseMessage(false,"error","Please try again!"));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient=Patient::find($id);
        return view('patient.edit',compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try{
            $patient=Patient::find($id);
            $patient->name=$request->name;
            $patient->patient_occupation=$request->patient_occupation;
            $patient->father=$request->father;
            $patient->father_occupation=$request->father_occupation;
            $patient->mother=$request->mother;
            $patient->mother_occupation=$request->mother_occupation;
            $patient->disease_name=$request->disease_name;
            $patient->age=$request->age;
            $patient->disease_description=$request->disease_description;
            $patient->hospital_name=$request->hospital_name;
            $patient->doctor_name=$request->doctor_name;
            $patient->spouse_name=$request->spouse_name;
            $patient->marital_status=$request->marital_status;
            $patient->treatment_cost=$request->treatment_cost;
            $patient->apply_amount=$request->apply_amount;
            $patient->contact=$request->contact;
            $patient->alt_contact=$request->alt_contact;
            $patient->family_member=$request->family_member;
            $patient->present_address=$request->present_address;
            $patient->permanent_address=$request->permanent_address;
            $patient->nid_birthid=$request->nid_birthid;
            if($request->has('photo')) 
                if($this->deleteImage($product->photo, 'patient_photo'))
                    $patient->photo = $this->uploadImage($request->file('photo'), 'patient_photo');
                else
                    $patient->photo = $this->uploadImage($request->file('photo'), 'patient_photo');

            
            if($request->has('pdf_documents')){
                $patient->pdf_documents = $this->uploadImage($request->file('pdf_documents'), 'patient_document');
            }
            if($request->has('id_card_font')){
                $patient->id_card_font = $this->uploadImage($request->file('id_card_font'), 'patient_id_card');
            }
            if($request->has('id_card_back')){
                $patient->id_card_back = $this->uploadImage($request->file('id_card_back'), 'patient_id_card');
            }
            $patient->status=$request->status;

            if(!!$patient->save()){
                return redirect(route(currentUser().'.patient.index'))->with($this->responseMessage(true,null,"user successfully created."));
            }
        }catch(Exception $e){
            dd($e);
            return redirect()->back()->with($this->responseMessage(false,"error","Please try again!"));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
