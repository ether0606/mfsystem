@extends('layout.app')
@section('title','Donor Voucher')
@section('content')
<div class="page-header">
    <h1>
        Donor Voucher
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Donor Voucher List
        </small>
        <a class="btn btn-primary pull-right" href="{{route(currentUser().'.donorvoucher.create')}}">Add New</a>
    </h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <table class="table">
            <thead>
                <tr>
                    <th>#SL</th>
                    <th>Voucher No</th>
                    <th>Date</th>
                    <th>Particulars</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($donorvoucher)
                    @foreach($donorvoucher as $j)
                        <tr>
                            <td>{{$j->id}}</td>
                            <td>{{$j->voucher_no}}</td>
                            <td>{{$j->v_date}}</td>
                            <td>{{$j->particular}}</td>
                            <td>{{$j->credit_sum}}</td>
                            <td><a href="{{route(currentUser().'.donorvoucher.show',$j->id)}}" ><i class="fa fa-eye"></i></a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        {!! $donorvoucher->links() !!}
    </div>
</div>
@endsection

@push('script')
@endpush