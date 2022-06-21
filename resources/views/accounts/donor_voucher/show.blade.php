@extends('layout.app')
@section('title','Donor Voucher')
@push('style')
<style>
select {
    padding: 3px 4px;
    height: 34px;
}
</style>
@endpush
@section('content')
<div class="page-header hidden-xs">
    <h1>
        Donor Voucher
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Donor Voucher Show
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<div class="widget-box transparent">
			<div class="widget-header widget-header-large">
				<h3 class="widget-title grey lighter">
					<i class="ace-icon fa fa-leaf green"></i>
					Donor Voucher
				</h3>

				<div class="widget-toolbar no-border invoice-info">
					<span class="invoice-info-label">Invoice:</span>
					<span class="red">#{{$donorvoucher->voucher_no}}</span>

					<br>
					<span class="invoice-info-label">Date:</span>
					<span class="blue">{{date('d/m-Y',strtotime($donorvoucher->v_date))}}</span>
				</div>

				<div class="widget-toolbar hidden-480">
					<a href="#" onclick="window.print()">
						<i class="ace-icon fa fa-print"></i>
					</a>
				</div>
			</div>

			<div class="widget-body">
				<div class="widget-main padding-24">
					<div class="row">
						<div class="col-xs-6">
							<div class="row">
								<div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
									<b>Donor Info</b>
								</div>
							</div>

							<div>
								<ul class="list-unstyled spaced">
									<li>
										<i class="ace-icon fa fa-caret-right blue"></i>{{$donor->name}}
									</li>

									<li>
										<i class="ace-icon fa fa-caret-right blue"></i>{{$donor->address}}
									</li>

									<li>
										<i class="ace-icon fa fa-caret-right blue"></i><b class="red">{{$donor->mobile}}</b>
									</li>
								</ul>
							</div>
						</div><!-- /.col -->

						<div class="col-xs-6">
							@if($donor_fund->fund_type==1)
								<div class="row">
									<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
										<b>Patient Info</b>
									</div>
								</div>

								<div>
									<ul class="list-unstyled  spaced">
										<li>
											<i class="ace-icon fa fa-caret-right blue"></i>{{$patient->name}}
										</li>

										<li>
											<i class="ace-icon fa fa-caret-right blue"></i>{{$patient->present_address}}
										</li>

										<li>
											<i class="ace-icon fa fa-caret-right blue"></i><b class="red">{{$patient->contact_no}}</b>
										</li>
									</ul>
								</div>
							@else
								<div class="row">
									<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
										@if($donor_fund->fund_type==2)
											<b>Medical Fund</b>
										@else
											<b>Zakat Fund</b>
										@endif
									</div>
								</div>
							@endif
						</div><!-- /.col -->
					</div><!-- /.row -->

					<div class="space"></div>

					<div>
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th class="center">#</th>
									<th>Payment Method</th>
									<th>Amount</th>
								</tr>
							</thead>

							<tbody>
								@foreach($donorbkdn as $bk)
									@if($bk->table_id!=28)
										<tr>
											<td class="center">1</td>
											<td>
												{{explode('-',$bk->account_code)[1]}}
											</td>
											<td>
													{{$bk->debit>0?$bk->debit:$bk->credit}}
											</td>
										</tr>
									@endif
								@endforeach
							</tbody>
						</table>
					</div>

					<div class="hr hr8 hr-double hr-dotted"></div>

					<div class="row">
						<div class="col-sm-5 pull-right">
							<h4 class="pull-right">
								Total amount :
								<span class="red">{{$donorvoucher->debit_sum}}</span>
							</h4>
						</div>
						<div class="col-sm-7 pull-left"> 
							{{$donorvoucher->bank_name?"Bank: ".$donorvoucher->bank_name."<br>":""}}	
							{{$donorvoucher->cheque_no?"Cheque No: ".$donorvoucher->cheque_no."<br>":""}}	
							{{$donorvoucher->cheque_date?"Cheque Date: ".date('d/m/Y',strtotime($donorvoucher->cheque_date))."<br>":""}}	
						</div>
					</div>

					<div class="space-6"></div>
					<div class="well">
					{{$donorvoucher->particular }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@push('script')

@endpush