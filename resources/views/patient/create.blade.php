@extends('layout.app')
@section('title','Patient Add')
@push('style')
<style>
select {
    padding: 3px 4px;
    height: 34px;
}
</style>
@endpush
@section('content')
<div class="page-header">
    <h1>
		Patients
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Patient Add
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
		@if(Session::has('response'))
			<div class="alert alert-{{Session::get('response')['class']}}">
			{{Session::get('response')['message']}}
			</div>
		@endif
        <!-- PAGE CONTENT BEGINS -->
        <div class="widget-box">
			<div class="widget-header widget-header-small">
				<h5 class="widget-title lighter">Patient Add Form</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<form action="{{route(currentUser().'.patient.store')}}" method="post" class="form-search" enctype="multipart/form-data">
					@csrf
						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group @if($errors->has('name')) has-error @endif">
									<label>Patient Name <span class="text-danger">*</span></label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="name" value="{{old('name')}}">
										@if($errors->has('name')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('name')) 
										<div class="help-block col-sm-reset">
									{{ $errors->first('name') }}
										</div>
								@endif
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group @if($errors->has('patient_occupation')) has-error @endif">
									<label>Patient Occupation <span class="text-danger">*</span></label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="patient_occupation" value="{{old('patient_occupation')}}">
										@if($errors->has('patient_occupation')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('patient_occupation')) 
										<div class="help-block col-sm-reset">
									{{ $errors->first('patient_occupation') }}
										</div>
								@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group @if($errors->has('father')) has-error @endif">
									<label>Father Name <span class="text-danger">*</span></label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="father" value="{{old('father')}}">
										@if($errors->has('father')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('father')) 
										<div class="help-block col-sm-reset">
											{{ $errors->first('father') }}
										</div>
									@endif
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group @if($errors->has('father_occupation')) has-error @endif">
									<label>Father Occupation <span class="text-danger">*</span></label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="father_occupation" value="{{old('father_occupation')}}">
										@if($errors->has('father_occupation')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('father_occupation')) 
										<div class="help-block col-sm-reset">
									{{ $errors->first('father_occupation') }}
										</div>
								@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group @if($errors->has('mother')) has-error @endif">
									<label>Mother Name <span class="text-danger">*</span></label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="mother" value="{{old('mother')}}">
										@if($errors->has('mother')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('mother')) 
										<div class="help-block col-sm-reset">
											{{ $errors->first('mother') }}
										</div>
									@endif
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group @if($errors->has('mother_occupation')) has-error @endif">
									<label>Mother Occupation <span class="text-danger">*</span></label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="mother_occupation" value="{{old('mother_occupation')}}">
										@if($errors->has('mother_occupation')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('mother_occupation')) 
										<div class="help-block col-sm-reset">
									{{ $errors->first('mother_occupation') }}
										</div>
								@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group @if($errors->has('disease_name')) has-error @endif">
									<label>Disease Name <span class="text-danger">*</span></label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="disease_name" value="{{old('disease_name')}}">
										@if($errors->has('disease_name')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('disease_name')) 
										<div class="help-block col-sm-reset">
											{{ $errors->first('disease_name') }}
										</div>
									@endif
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group @if($errors->has('disease_description')) has-error @endif">
									<label>Disease Description <span class="text-danger">*</span></label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="disease_description" value="{{old('disease_description')}}">
										@if($errors->has('disease_description')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('disease_description')) 
										<div class="help-block col-sm-reset">
											{{ $errors->first('disease_description') }}
										</div>
									@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-3">
								<div class="form-group">
									<label>Hospital Name</label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="hospital_name" value="{{old('hospital_name')}}">
									</span>
								</div>
							</div>
							<div class="col-xs-12 col-sm-3">
								<div class="form-group">
									<label>Doctor Name</label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="doctor_name" value="{{old('doctor_name')}}">
									</span>
								</div>
							</div>
							<div class="col-xs-12 col-sm-3">
								<div class="form-group @if($errors->has('treatment_cost')) has-error @endif">
									<label>Treatment Cost <span class="text-danger">*</span></label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="treatment_cost" value="{{old('treatment_cost')}}">
										@if($errors->has('treatment_cost')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('treatment_cost')) 
										<div class="help-block col-sm-reset">
											{{ $errors->first('treatment_cost') }}
										</div>
									@endif
								</div>
							</div>
							<div class="col-xs-12 col-sm-3">
								<div class="form-group @if($errors->has('apply_amount')) has-error @endif">
									<label>Apply Amount <span class="text-danger">*</span></label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="apply_amount" value="{{old('apply_amount')}}">
										@if($errors->has('apply_amount')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('apply_amount')) 
										<div class="help-block col-sm-reset">
											{{ $errors->first('apply_amount') }}
										</div>
									@endif
								</div>
							</div>
							
							<div class="col-xs-12 col-sm-3">
								<div class="form-group @if($errors->has('age')) has-error @endif">
									<label>Age <span class="text-danger">*</span></label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="age" value="{{old('age')}}">
										@if($errors->has('age')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('age')) 
										<div class="help-block col-sm-reset">
											{{ $errors->first('age') }}
										</div>
									@endif
								</div>
							</div>
							
							<div class="col-xs-12 col-sm-3">
								<div class="form-group @if($errors->has('marital_status')) has-error @endif">
									<label>Marital Status <span class="text-danger">*</span></label>
									<span class="block input-icon input-icon-right">
									@php $marital_status=array('Unmarried','Married'); @endphp
										<select onchange="this.value=='1'?$('.spouse_name').show():$('.spouse_name').hide() " class="width-100" name="marital_status">
											<option value="">Select Status</option>
											@if($marital_status)
												@foreach($marital_status as $i=>$s)
													<option value="{{$i}}" @if($i==old('marital_status')) selected @endif>{{$s}}</option>
												@endforeach
											@endif
										</select>
										@if($errors->has('marital_status')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('marital_status')) 
										<div class="help-block col-sm-reset">
											{{ $errors->first('status') }}
										</div>
									@endif
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 spouse_name" style="display:none">
								<div class="form-group">
									<label>Spouse Name</label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="spouse_name" value="{{old('spouse_name')}}">
									</span>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group @if($errors->has('present_address')) has-error @endif">
									<label>Present Address <span class="text-danger">*</span></label>
									<span class="block input-icon input-icon-right">
										<textarea class="width-100" name="present_address" value="{{old('present_address')}}"></textarea>
										@if($errors->has('present_address')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('present_address')) 
										<div class="help-block col-sm-reset">
											{{ $errors->first('present_address') }}
										</div>
									@endif
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group @if($errors->has('permanent_address')) has-error @endif">
									<label>Permanent Address <span class="text-danger">*</span></label>
									<span class="block input-icon input-icon-right">
										<textarea class="width-100" name="permanent_address" value="{{old('permanent_address')}}"></textarea>
										@if($errors->has('permanent_address')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('permanent_address')) 
										<div class="help-block col-sm-reset">
											{{ $errors->first('permanent_address') }}
										</div>
									@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-4">
								<div class="form-group @if($errors->has('contact')) has-error @endif">
									<label>Contact Number <span class="text-danger">*</span></label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="contact" value="{{old('contact')}}">
										@if($errors->has('contact')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('contact')) 
										<div class="help-block col-sm-reset">
											{{ $errors->first('contact') }}
										</div>
									@endif
								</div>
							</div>
							<div class="col-xs-12 col-sm-4">
								<div class="form-group">
									<label>Other Contact Number</label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="alt_contact" value="{{old('alt_contact')}}">
									</span>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4">
								<div class="form-group">
									<label>Family Member</label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="family_member" value="{{old('family_member')}}">
									</span>
								</div>
							</div>
						</div>

						<div class="row">
							
							<div class="col-xs-12 col-sm-4">
								<div class="form-group @if($errors->has('nid_birthid')) has-error @endif">
									<label>NID / Birth Certificate Number <span class="text-danger">*</span></label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="nid_birthid" value="{{old('nid_birthid')}}">
										@if($errors->has('nid_birthid')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('nid_birthid')) 
										<div class="help-block col-sm-reset">
											{{ $errors->first('nid_birthid') }}
										</div>
									@endif
								</div>
							</div>
							<div class="col-xs-12 col-sm-4">
								<div class="form-group">
									<label>ID Card Front Page Photo</label>
									<span class="block input-icon input-icon-right">
										<input type="file" class="width-100" name="id_card_font">
									</span>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4">
								<div class="form-group">
									<label>ID Card Back Page Photo</label>
									<span class="block input-icon input-icon-right">
										<input type="file" class="width-100" name="id_card_back">
									</span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-4">
								<div class="form-group">
									<label>Patient Photo</label>
									<span class="block input-icon input-icon-right">
										<input type="file" class="width-100" name="photo">
									</span>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4">
								<div class="form-group">
									<label>Other Document (PDF)</label>
									<span class="block input-icon input-icon-right">
										<input type="file" class="width-100" name="pdf_documents">
									</span>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4">
								<div class="form-group @if($errors->has('status')) has-error @endif">
									<label>Status <span class="text-danger">*</span></label>
									<span class="block input-icon input-icon-right">
									@php $status=array('Inactive','active','Pending','Freez','Block'); @endphp
										<select class="width-100" name="status">
											<option value="">Select Status</option>
											@if($status)
												@foreach($status as $i=>$s)
											<option value="{{$i}}" @if($i==old('status')) selected @endif>{{$s}}</option>
												@endforeach
											@endif
										</select>
										@if($errors->has('status')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('status')) 
										<div class="help-block col-sm-reset">
									{{ $errors->first('status') }}
										</div>
								@endif
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-sm-12 text-right">
								<button class="btn btn-primary" type="submit"> Submit </button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
    </div>
</div>

@endsection