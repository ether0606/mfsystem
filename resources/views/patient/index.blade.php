@extends('layout.app')
@section('title','Patients')
@section('content')
<div class="page-header">
    <h1>
		Patients
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Patient List
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

    <a class="btn btn-primary pull-right" href="{{route(currentUser().'.patient.create')}}">Add New</a>
        <!-- PAGE CONTENT BEGINS -->
        <table class="table">
            <thead>
                <tr>
                    <th>#SL</th>
                    <th>Name</th>
                    <th>Father</th>
                    <th>Contact</th>
                    <th>Disease</th>
                    <th>Age</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($patients)
                    @foreach($patients as $i=>$u)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$u->name}}</td>
                            <td>{{$u->father}}</td>
                            <td>{{$u->contact_no}}</td>
                            <td>{{$u->disease_name}}</td>
                            <td>{{$u->age}}</td>
                            <td>{{$u->apply_amount}}</td>
                            <td>
                                <a href="{{route(currentUser().'.patient.edit',$u->id)}}" ><i class="fa fa-edit"></i></a>
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


@endpush