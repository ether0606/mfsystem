@extends('layout.app')
@section('title','Master Head')
@section('content')
<div class="page-header">
    <h1>
	Master Head
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Master Head List
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
				<h5 class="widget-title lighter">Master Head Add Form</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<form action="{{route('masterhead.store')}}" method="post" class="form-search" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="id" id="hid" value="0">
						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group @if($errors->has('head_name')) has-error @endif">
									<label>Master Head Name</label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="head_name" id="head_name" value="{{old('head_name')}}">
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
								<div class="form-group @if($errors->has('head_code')) has-error @endif">
									<label>Code</label>
									<span class="block input-icon input-icon-right">
										<input type="text" class="width-100" name="head_code" id="head_code" value="{{old('head_code')}}">
										@if($errors->has('head_code')) 
											<i class="ace-icon fa fa-times-circle"></i>
										@endif
									</span>
									@if($errors->has('head_code')) 
										<div class="help-block col-sm-reset">
									        {{ $errors->first('head_code') }}
										</div>
								    @endif
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
                    <th>Head Name</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @if($masterhead)
                    @foreach($masterhead as $i=>$u)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$u->head_name}}</td>
                            <td>{{$u->head_code}}</td>
                            <td>
                                <a onclick="get_edit({{json_encode($u)}})" href="javascript:void()" ><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

</div>

@endsection

@push('script')

<!-- page specific plugin scripts -->

<!-- inline scripts related to this page -->
<script type="text/javascript">
	function get_edit(e){
	    $('#hid').val(e.id);
	    $('#head_name').val(e.head_name);
	    $('#head_code').val(e.head_code);
	}
	function clear_data(){
	    $('#hid').val(0);
	    $('#head_name').val("");
	    $('#head_code').val("");
	}
</script>

@endpush