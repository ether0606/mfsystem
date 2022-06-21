@extends('layout.app')
@section('title','Child Head Two')
@section('content')
<div class="page-header">
    <h1>
	Child Head Two
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Child Head Two List
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
				<h5 class="widget-title lighter">Child Head Add Form</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<form action="{{route('chieldtwo.store')}}" method="post" class="form-search" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="id" id="hid" value="0">
						<div class="row">
    						<div class="col-xs-12 col-sm-6">
    							<div class="form-group @if($errors->has('chieldheadone_id')) has-error @endif">
									<label>Child Head One</label>
									<span class="block input-icon input-icon-right">
										<select class="width-100" id="chieldheadone_id" name="chieldheadone_id">
											<option value="">Select Head</option>
											@if($chield_one)
												@foreach($chield_one as $vc)
											<option value="{{$vc->id}}" @if($vc->id==old('head_name')) selected @endif>{{$vc->head_name}}</option>
												@endforeach
											@endif
										</select>
										@if($errors->has('chieldheadone_id')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('chieldheadone_id')) 
										<div class="help-block col-sm-reset">
									{{ $errors->first('chieldheadone_id') }}
										</div>
									@endif
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group @if($errors->has('head_name')) has-error @endif">
									<label>Head Name</label>
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
								<div class="form-group @if($errors->has('chieldtwo_code')) has-error @endif">
									<label>Head Code</label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" id="chieldtwo_code" name="chieldtwo_code" value="{{old('chieldtwo_code')}}">
										@if($errors->has('chieldtwo_code')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('chieldtwo_code')) 
										<div class="help-block col-sm-reset">
									{{ $errors->first('chieldtwo_code') }}
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
                    <th>Child Head One</th>
                    <th>Head Name</th>
                    <th>Head Code</th>
                    <th>Opening Balance</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @if($chieldtwo)
                    @foreach($chieldtwo as $i=>$u)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$u->chield_one->head_name}}</td>
                            <td>{{$u->head_name}}</td>
                            <td>{{$u->chieldtwo_code}}</td>
                            <td>{{$u->opening_balance}}</td>
                            <td>
                                <a onclick="get_edit({{json_encode($u)}})" href="javascript:void(0);" ><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        {{ $chieldtwo->links() }}
    </div>

</div>

@endsection

@push('script')

<!-- page specific plugin scripts -->

<!-- inline scripts related to this page -->
<script type="text/javascript">
	function get_edit(e){
	    $('#hid').val(e.id);
	    $('#chieldheadone_id').val(e.chieldheadone_id);
	    $('#head_name').val(e.head_name);
	    $('#chieldtwo_code').val(e.chieldtwo_code);
	    $('#opening_balance').val(e.opening_balance);
	}
	function clear_data(){
	    $('#hid').val(0);
	    $('#chieldheadone_id').val("");
	    $('#head_name').val("");
	    $('#chieldtwo_code').val("");
	    $('#opening_balance').val("");
	}
</script>

@endpush