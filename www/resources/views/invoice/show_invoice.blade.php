<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{asset('css/inv-pdf.css')}}" type="text/css">
</head>
<body>
<div class="inv-template">
    <div class="company pl-30 pr-30">
        <table>
            <tbody>
            <tr>
                <td class="info">
                    <div class="logo"><img src="{{config('global.site_logo')}}" alt="logo"></div>
                    <div class="name">{{config('global.name')}}</div>
                    <div class="text">@foreach(explode(',',config('global.address')) as $address){{$address}},
                        <br>@endforeach</div>
                </td>
                <td class="text-right">
                    <div class="title">Invoice</div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="meta pl-30 pr-30">
        <table>
            <tbody>
            <tr>
                <td class="bill-to v-aling-bottom">
                    <div class="heading">Bill To</div>
                    <div class="title">{{$invoice->name}}</div>
                    <div class="text">{{$invoice->mobile}}</div>
                </td>
                <td class="info v-aling-bottom">
                    <table class="text-right">
                        <tbody>
                        <tr>
                            <td class="text">Invoice Date</td>
                            <td class="text w-min-130">{{\Carbon\Carbon::parse($invoice->invoicedate)->format('d-m-Y')}}</td>
                        </tr>
                        <tr>
                            <td class="text">Due Date</td>
                            <td class="text w-min-130">{{\Carbon\Carbon::parse($invoice->duedate)->format('d-m-Y')}}</td>
                        </tr>
                        <tr>
                            <td class="text">Payment Method</td>
                            <td class="text w-min-130">{{config('constants.PAYMENT_METHODS')[$invoice->method]}}</td>
                        </tr>
                        <tr>
                            <td class="text">Status</td>
                            <td class="text w-min-130">{{config('constants.PAYMENT_STATUS')[$invoice->status]}}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="item pl-30 pr-30">
        <table>
            <thead>
            <tr>
                <th>No.</th>
                <th>Item Name</th>
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
                        <td class="title">
                            <p>{{$item_row->name}}</p>
                            <span>{{$item_row->descr}}</span>
                        </td>
                        <td>{{$item_row->size}}</td>
                        <td>{{$item_row->quantity}}</td>
                        <td>{{$item_row->cost}}</td>
                        <td class="text-right">{{$item_row->quantity * $item_row->cost}}</td>
                    </tr>
                @endforeach
            @endif

            <tr class="total">
                <td rowspan="9" colspan="4" class="blank">

                </td>
                <td class="title">Sub Total</td>
                <td class="value text-right">{{$invoice->subtotal}}</td>
            </tr>
            <tr class="total">
                <td class="title">Tax</td>
                <td class="value text-right">{{$invoice->tax}}%</td>
            </tr>
            @if(!empty($invoice->discount_type))
                <tr class="total">
                    <td class="title">Total</td>
                    <td class="value text-right"> {{$invoice->subtotal + (($invoice->subtotal * $invoice->tax) / 100)}}</td>
                </tr>
                <tr class="total">
                    <td class="title">Discount</td>
                    @if($invoice->discount_type == 'FLAT')
                        <td class="value text-right">-{{$invoice->discount}}</td>
                    @else
                        <td class="value text-right">{{$invoice->discount}}%<br>-{{$invoice->discount_value}}<br/>
                        </td>
                    @endif
                </tr>
            @endif
            <tr class="total">
                <td class="title">Paid</td>
                <td class="value text-right">{{$invoice->paid}}</td>
            </tr>
            <tr class="total">
                <td class="title">Due</td>
                <td class="value text-right">{{$invoice->due}}</td>
            </tr>
            <tr class="total">
                <td class="title">Grand Total</td>
                <td class="value text-right">Rs.{{$invoice->amount}}</td>
            </tr>
            <tr class="total">
                <td class="title" colspan="2" style="border: 0px"></td>
            </tr>
            <tr class="total">
                <td class="title" colspan="2">AUTHORISED SIGNATORY <br/><br/><br/><br/>{{config('global.name')}}</td>
            </tr>
            </tbody>
        </table>
    </div>
{{--    <div class="note pl-30 pr-30">--}}
{{--        <table>--}}
{{--            <tbody>--}}
{{--            <tr>--}}
{{--                <td rowspan="4" colspan="5" class="blank">--}}

{{--                </td>--}}
{{--                <td>--}}
{{--                    <span>AUTHORISED SIGNATORY FOR<br>{{config('global.name')}}</span>--}}
{{--                    <p></p>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}
</div>
</body>
</html>
