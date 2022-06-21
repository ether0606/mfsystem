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
									<label>Patient Name</label>
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
									<label>Patient Occupation</label>
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
									<label>Father Name</label>
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
									<label>Father Occupation</label>
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
									<label>Mother Name</label>
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
									<label>Mother Occupation</label>
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
									<label>Disease Name</label>
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
									<label>Disease Description</label>
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
							<div class="col-xs-12 col-sm-2">
								<div class="form-group @if($errors->has('age')) has-error @endif">
									<label>Age</label>
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
							
							
							<div class="col-xs-12 col-sm-4">
								<div class="form-group">
									<label>Hospital Name</label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="hospital_name" value="{{old('hospital_name')}}">
									</span>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4">
								<div class="form-group">
									<label>Doctor Name</label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="doctor_name" value="{{old('doctor_name')}}">
									</span>
								</div>
							</div>
							
							<div class="col-xs-12 col-sm-2">
								<div class="form-group @if($errors->has('marital_status')) has-error @endif">
									<label>Marital Status</label>
									<span class="block input-icon input-icon-right">
									@php $marital_status=array('Married','Unmarried'); @endphp
										<select class="width-100" name="marital_status">
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
							
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group @if($errors->has('contact')) has-error @endif">
									<label>Contact</label>
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
							
							
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label>Password</label>
									<span class="block input-icon input-icon-right">
										<input type="password" class="width-100" name="password" value="" autocomplete="kamal">
									</span>
								</div>
							</div>
							
							<div class="col-xs-12 col-sm-6">
								<div class="form-group @if($errors->has('username')) has-error @endif">
									<label>Username</label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="username" value="{{old('username')}}">
										@if($errors->has('username')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('username')) 
										<div class="help-block col-sm-reset">
									{{ $errors->first('username') }}
										</div>
								@endif
								</div>
							</div>
							
							
							<div class="col-xs-12 col-sm-6">
								<div class="form-group @if($errors->has('status')) has-error @endif">
									<label>Status</label>
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