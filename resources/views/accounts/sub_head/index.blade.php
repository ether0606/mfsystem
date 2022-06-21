@extends('layout.app')
@section('title','Sub Head')
@section('content')
<div class="page-header">
    <h1>
	Sub Head
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Sub Head List
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
	<div class="col-xs-6">
	@if(Session::has('response'))
        <div class="alert alert-{{Session::get('response')['class']}}">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{Session::get('response')['message']}}
        </div>
    @endif
        <!-- PAGE CONTENT BEGINS -->
        <div class="widget-box">
			<div class="widget-header widget-header-small">
				<h5 class="widget-title lighter">Sub Head Add Form</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<form action="{{route('subhead.store')}}" method="post" class="form-search" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="id" id="hid" value="0">
						<div class="row">
    						<div class="col-xs-12 col-sm-6">
    							<div class="form-group @if($errors->has('vcategory')) has-error @endif">
									<label>Master Head</label>
									<span class="block input-icon input-icon-right">
										<select class="width-100" id="masterhead_id" name="masterhead_id">
											<option value="">Select Head</option>
											@if($masterhead)
												@foreach($masterhead as $vc)
											<option value="{{$vc->id}}" @if($vc->id==old('head_name')) selected @endif>{{$vc->head_name}}</option>
												@endforeach
											@endif
										</select>
										@if($errors->has('masterhead_id')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('masterhead_id')) 
										<div class="help-block col-sm-reset">
									        {{ $errors->first('masterhead_id') }}
										</div>
									@endif
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group @if($errors->has('head_name')) has-error @endif">
									<label>Sub Head Name</label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" id="head_name" name="head_name" value="{{old('head_name')}}">
										@if($errors->has('head_name')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('head_name')) 
										<div class="help-block col-sm-reset">
									{{ $errors->first('head_name') }}
										</div>
								@endif
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group @if($errors->has('subhead_code')) has-error @endif">
									<label>Code</label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" id="subhead_code" name="subhead_code" value="{{old('subhead_code')}}">
										@if($errors->has('subhead_code')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('subhead_code')) 
										<div class="help-block col-sm-reset">
									{{ $errors->first('subhead_code') }}
										</div>
								@endif
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label>Opening Balance</label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" id="opening_balance" name="opening_balance" value="{{old('opening_balance')}}">
										@if($errors->has('opening_balance')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12 text-right">
								<button class="btn btn-danger" onclick="clear_data()" type="reset"> Clear </button>
								<button class="btn btn-primary" type="submit"> Submit </button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
    <div class="col-xs-6">
        <!-- PAGE CONTENT BEGINS -->
        <table class="table">
            <thead>
                <tr>
                    <th>#SL</th>
                    <th>Master Head</th>
                    <th>Head Name</th>
                    <th>Head Code</th>
                    <th>Opening Balance</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @if($subhead)
                    @foreach($subhead as $i=>$u)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$u->master_head->head_name}}</td>
                            <td>{{$u->head_name}}</td>
                            <td>{{$u->subhead_code}}</td>
                            <td>{{$u->opening_balance}}</td>
                            <td>
                                <a onclick="get_edit({{json_encode($u)}})" href="javascript:void(0);" ><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
		{{ $subhead->links() }}
    </div>
</div>

@endsection

@push('script')

<!-- page specific plugin scripts -->

<!-- inline scripts related to this page -->
<script type="text/javascript">
	function get_edit(e){
	    $('#hid').val(e.id);
	    $('#masterhead_id').val(e.masterhead_id);
	    $('#head_name').val(e.head_name);
	    $('#subhead_code').val(e.subhead_code);
	    $('#opening_balance').val(e.opening_balance);
	}
	function clear_data(){
	    $('#hid').val(0);
	    $('#masterhead_id').val("");
	    $('#head_name').val("");
	    $('#subhead_code').val("");
	    $('#opening_balance').val("");
	}
</script>

@endpush