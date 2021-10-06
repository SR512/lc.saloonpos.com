@extends('layouts.master')

@section('title') View Invoice @endsection
@section('css')

@endsection
@section('content')

    @component('common-components.breadcrumb',['li_1'=>['Dashboard'=>route('home'),'Invoice List' =>route('invoice.index') ]])
        @slot('title') View Invoice  @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
{{--                        <h4 class="float-right font-size-16">Order # 12345</h4>--}}
                        <div class="mb-4">
                            <img src="{{config('global.site_logo')}}" alt="logo" height="50px"/>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <address>
                                <strong>Billed To:</strong><br>
                                {{$invoice->name}}<br>
                                {{$invoice->mobile}}<br>
                            </address>
                        </div>
                        <div class="col-6 text-right">
                            <address>
                                <strong>Billed From:</strong><br>
                                <p style="text-align: right">
                                    {{config('global.name')}}<br>
                                    @foreach(explode(',',config('global.address')) as $address)
                                        {{$address}},<br>
                                    @endforeach
                                </p>
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-3">
                            <address>
                                <strong>GSTIN(NO):</strong>{{config('global.gst')}}<br>
                                <strong>Payment
                                    Method: </strong>{{config('constants.PAYMENT_METHODS')[$invoice->method]}}<br>
                                <strong>Payment
                                    Status: </strong>{{config('constants.PAYMENT_STATUS')[$invoice->status]}}<br>
                            </address>
                        </div>
                        <div class="col-6 mt-3 text-right">
                            <address>
                                <strong>Order Date:</strong><br>
                                {{\Carbon\Carbon::parse($invoice->invoicedate)->format('M d').",".\Carbon\Carbon::parse($invoice->invoicedate)->format('Y')}}
                                <br><br>
                            </address>
                        </div>
                    </div>
                    <div class="py-2 mt-3">
                        <h3 class="font-size-15 font-weight-bold">Order summary</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-nowrap">
                            <thead>
                            <tr>
                                <th style="width: 70px;">No.</th>
                                <th style="width: 30%;">Item Name</th>
                                <th>Item Size</th>
                                <th>Quantity</th>
                                <th>Unit Cost</th>
                                <th class="text-right">Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($invoice->items))
                                @foreach(json_decode($invoice->items) as $key => $item_row)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item_row->name}}<br>
                                            <p>{{$item_row->descr}}</p></td>
                                        <td>{{$item_row->size}}</td>
                                        <td>{{$item_row->quantity}}</td>
                                        <td>{{$item_row->cost}}</td>
                                        <td class="text-right">{{$item_row->quantity * $item_row->cost}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            <tr>
                                <td colspan="5" class="text-right">Sub Total</td>
                                <td class="text-right">Rs.{{$invoice->subtotal}}</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="border-0 text-right">
                                    <strong>Tax</strong></td>
                                <td class="border-0 text-right">{{$invoice->tax}}%</td>
                            </tr>
                            @if(!empty($invoice->discount_type))
                                <tr>
                                    <td colspan="5" class="border-0 text-right">
                                        <strong>Total</strong></td>
                                    <td class="border-0 text-right"> {{$invoice->subtotal + (($invoice->subtotal * $invoice->tax) / 100)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="border-0 text-right">
                                        <strong>Discount</strong></td>
                                    @if($invoice->discount_type == 'FLAT')
                                        <td class="border-0 text-right">
                                            -{{$invoice->discount}}
                                        </td>
                                    @else
                                        <td class="border-0 text-right">
                                            {{$invoice->discount}}%<br>
                                            -{{$invoice->discount_value}}<br/>
                                        </td>
                                        @endif
                                        </td>
                                </tr>
                            @endif
                            <tr>
                                <td colspan="5" class="border-0 text-right">
                                    <strong>Paid</strong></td>
                                <td class="border-0 text-right"> {{$invoice->paid}}</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="border-0 text-right">
                                    <strong>Due</strong></td>
                                <td class="border-0 text-right"> {{$invoice->due}}</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="border-0 text-right">
                                    <strong>Grand Total</strong></td>
                                <td class="border-0 text-right">
                                    <h4 class="m-0">Rs.{{$invoice->amount}}</h4></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-print-none">
                        <div class="float-right">
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i
                                    class="fa fa-print"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')

    <script src="{{ URL::asset('/js/pages/invoice.js')}}"></script>

@endsection
