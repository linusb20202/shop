@extends('layouts.inner')
@section('content')
{{ HTML::script('public/js/facebox.js')}}
{{ HTML::style('public/css/facebox.css')}}
{{ HTML::script('public/js/front/bootstrap.min.js')}}
<script type="text/javascript">
    $(document).ready(function ($) {
        $('.close_image').hide();
        $('a[rel*=facebox]').facebox({
            closeImage: '{!! HTTP_PATH !!}/public/img/close.png'
        });
    });
</script>
<div class="main_dashboard">
   <section class="dashboard-section">
        <div class="container">
            <div class="manage-btn">Manage Selling Orders </div>
            <div class="management-bx">
                <div class="ee er_msg">@include('elements.errorSuccessMessage')</div>
                <div class="management-bx-over">
                    @if(!$allrecords->isEmpty())
                    <div class="management-table">
                        <div class="management-table-tr">
                            <div class="management-table-th">Date</div>
                            <div class="management-table-th">Buyer Name</div>
                            <div class="management-table-th">Gig Title</div>
                            <div class="management-table-th">Order ID</div>
                            <div class="management-table-th">Amount</div>
                            <div class="management-table-th">Status</div>
                            <div class="management-table-th">Action</div>
                        </div>
                        <?php global $gigOrderStatus; ?>
                        @foreach($allrecords as $allrecord)
                            <div class="management-table-tr">
                                <div class="management-table-td">{{$allrecord->created_at->format('d M, Y')}}</div>
                                <div class="management-table-td">{{$allrecord->Buyer ? $allrecord->Buyer->user_name : ''}}</div>
                                <div class="management-table-td">{!! str_limit($allrecord->Gig->title, $limit = 20, $end = ' ...') !!}</div>
                                <div class="management-table-td">
                                    @if($allrecord->pay_type === 'Wallet')
                                        {{$allrecord->wallet_trn_id}}
                                    @else 
                                        {{$allrecord->paypal_trn_id}}
                                    @endif
                                </div>
                                <div class="management-table-td">
                                    <?php $val = $allrecord->revenue-$allrecord->admin_commission;?>
                                    {{CURR.$val}}
                                </div>
                                <div class="management-table-td">{{$gigOrderStatus[$allrecord->status]}}</div>
                                <div class="management-table-td">
                                    <a href="#info{!! $allrecord->id !!}" title="View Offer Details" class="btn btn-primary btn-xs" rel='facebox'><i class="fa fa-eye"></i></a>
                                    @if($allrecord->status == 2 && $allrecord->is_seller_rate != 1)
                                        <a href="{{ URL::to('myorders/ratebuyer/'.$allrecord->slug)}}" title="Rate Buyer" class="btn btn-primary btn-xs"><i class="fa fa-star"></i></a>
                                    @endif
                                    <a href="{{ URL::to( 'myorders/workplace/'.$allrecord->slug)}}" title="Go to Workplace" class="btn btn-success btn-xs"><i class="fa fa-tasks"></i></i></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @else
                        <div class="management-full">No requests found. </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>

@if(!$allrecords->isEmpty())
@foreach($allrecords as $allrecord)
<div id="info{!! $allrecord->id !!}" style="display: none;" class="frnt_div">
    <div class="nzwh-wrapper">
        <fieldset class="nzwh">
            <legend class="head_pop">
                Order #
                @if($allrecord->pay_type === 'Wallet')
                    {{$allrecord->wallet_trn_id}}
                @else 
                    {{$allrecord->paypal_trn_id}}
                @endif
            </legend>
            <div class="drt">
                <div class="admin_pop"><span>Buyer Name: </span>  <label>{!! $allrecord->Buyer?$allrecord->Buyer->user_name:'N/A' !!}</label></div>
                <div class="admin_pop"><span>Gig Title: </span>  <label>{!! str_limit($allrecord->Gig->title, $limit = 40, $end = ' ...') !!}</label></div>
                <div class="admin_pop"><span>Order Date: </span>  <label>{{$allrecord->created_at->format('d M, Y')}}</label></div>
                <div class="admin_pop"><span>Order ID: </span>  <label>
                    @if($allrecord->pay_type === 'Wallet')
                        {{$allrecord->wallet_trn_id}}
                    @else 
                        {{$allrecord->paypal_trn_id}}
                    @endif
                    </label>
                </div>
                <div class="admin_pop"><span>Package: </span>  <label>{{ucfirst($allrecord->package)}}</label></div>
                <div class="admin_pop"><span>Amount: </span>  <label>{{$allrecord->revenue}}</label></div>
                <div class="admin_pop"><span>Status: </span>  <label>{{$gigOrderStatus[$allrecord->status]}}</label></div>
        </fieldset>
    </div>
</div>
@endforeach
@endif
@endsection