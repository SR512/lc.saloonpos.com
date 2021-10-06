@extends('layouts.master')

@section('title') New Seller Invoice @endsection
@section('css')
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

    @component('common-components.breadcrumb',['li_1'=>['Dashboard'=>route('home'),'Seller Invoice List' =>route('sellerinvoice.index') ]])
        @slot('title') New Seller Invoice  @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <a href="{{route('sellerinvoice.index')}}" class="btn btn-primary btn-sm"><i
                                class="mdi mdi-arrow-left"></i> Back Seller Invoice List</a>
                    </div>
                    <div class="float-left">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    {!! Form::open(['url' => route('sellerinvoices.store'),'id'=>'seller-invoice-form','method'=>'post']) !!}

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Seller name', ['class' => 'col-form-label']); !!}
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="mdi mdi-account"></i></span>
                                            </div>
                                            {!! Form::text('name','',['class' => 'form-control','placeholder'=>'Enter seller name','required'=>true]); !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('email', 'Email Address', ['class' => 'col-form-label']); !!}
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="mdi mdi-email"></i></span>
                                            </div>
                                            {!! Form::text('email','',['class' => 'form-control customer-mail','id'=>'patient-mail','placeholder'=>'Enter Customer Email Address . . .','required'=>true]); !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('mobile', 'Seller Phone/Mobile number', ['class' => 'col-form-label']); !!}
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="mdi mdi-phone"></i></span></div>
                                            {!! Form::text('mobile','',['class' => 'form-control customer-mobile','maxlength'=>'10','id'=>'patient-mobile','placeholder'=>'Enter Patient Mobile No . . .','required'=>true]); !!}

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('invoicedate', 'Invoice Date', ['class' => 'col-form-label']); !!}
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="mdi mdi-calendar"></i></span>
                                            </div>
                                            {!! Form::date('invoicedate',\Carbon\Carbon::now()->format('Y-m-d'),['class' => 'form-control']); !!}

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('duedate', 'Due Date', ['class' => 'col-form-label']); !!}
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="mdi mdi-calendar"></i></span>
                                            </div>
                                            {!! Form::date('duedate',\Carbon\Carbon::now()->format('Y-m-d'),['class' => 'form-control']); !!}

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-items table-responsive pt-3 pb-5">
                                <table class="table table-responsive">
                                    <thead>
                                    <tr>
                                        <th>Item Name <span class="form-required">*</span></th>
                                        <th>Item Size <span class="form-required">*</span></th>
                                        <th>Item Description</th>
                                        <th>Quantity <span class="form-required">*</span></th>
                                        <th>Unit Cost <span class="form-required">*</span></th>
                                        <th>Price</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="item-row">
                                        <td style="width:20%">
                                            <select name="item[0][name]" class="item-name form-control"
                                                    data-row="0" onchange="getProduct(event)">
                                                <option value="">Select Product</option>
                                                @if($products_with_size_data)
                                                    @foreach($products_with_size_data as $key => $row)
                                                        <option value="{{$row['product_name']}}"
                                                                data-size="{{json_encode($row['size'])}}" data-id="{{$row['product_id']}}">{{$row['product_name']}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <input type="hidden" name="item[0][product_id]" class="item-product-id form-control" required>
                                        </td>
                                        <td style="width:15%">
                                            <select name="item[0][size]" class="item-size form-control"
                                                    data-row="0" onchange="getSizePrice(event)">
                                                <option value="">Select size</option>
                                            </select>
                                            <input type="hidden" name="item[0][size_id]" class="item-size-id form-control" required>
                                        </td>
                                        <td class="invoice-item" style="width:20%">
                                            <textarea name="item[0][descr]"
                                                      class="item-descr form-control"></textarea>
                                        </td>
                                        <td class="" style="width:15%">
                                            <input type="number" name="item[0][quantity]"
                                                   class="item-quantity form-control"
                                                   required>
                                        </td>
                                        <td class="">
                                            <input type="number" name="item[0][cost]"
                                                   class="item-cost form-control"/>
                                        </td>
                                        <td class="">
                                            <input type="number" name="item[0][price]"
                                                   class="item-total-price form-control" readonly/>
                                            <input type="hidden" class="item-price">
                                        </td>
                                        <td>
                                            <!--                                <a class="badge badge-warning badge-sm badge-pill add-taxes m-1">Add Taxes</a>-->
                                            <button type="button" class="btn btn-sm btn-danger delete m-1">X</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="p-2">
                                            <div class="add-items">
                                                <button type="button" class="btn btn-success btn-sm m-1"><i
                                                        class="mdi mdi-plus mr-1"></i>Add Item
                                                </button>
                                            </div>
                                        </td>
                                        <td colspan="2" class="total-line">
                                            <label>Sub Total</label>
                                        </td>
                                        <td colspan="2" class="total-value">
                                            <input type="number" name="subtotal"
                                                   class="form-control sub-total"
                                                   value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="blank">
                                        </td>
                                        <td colspan="2" class="total-line">
                                            <label>Tax</label>
                                        </td>
                                        <td colspan="2" class="total-value">
                                            <input type="number" name="tax" class="form-control tax-total"
                                                   value="5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="blank">
                                        </td>
                                        <td colspan="2" class="total-line">
                                            <div class="row align-items-center">
                                                <div class="col-6"><label>Discount</label></div>
                                                <div class="col-6">
                                                    {!! Form::select('discounttype',config('constants.DISCOUNT_TYPE'),null,['class' => 'form-control discount-type','placeholder'=>'Discount type']); !!}

                                                </div>
                                            </div>
                                        </td>
                                        <td colspan="2" class="total-value">
                                            <input type="number" name="discount"
                                                   class="form-control discount-total"
                                                   value="">
                                            <input type="hidden" class="discount_amount"
                                                   name="discount_value"
                                                   value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="blank">
                                        </td>
                                        <td colspan="2" class="total-line">
                                            <label>Total</label>
                                        </td>
                                        <td colspan="2" class="total-value">
                                            <input type="number" name="amount"
                                                   class="form-control  total-amount"
                                                   value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="blank">
                                        </td>
                                        <td colspan="2" class="total-line">
                                            <label>Paid</label>
                                        </td>
                                        <td colspan="2" class="total-value">
                                            <input type="number" name="paid"
                                                   class="form-control paid-amount"
                                                   value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="blank">
                                        </td>
                                        <td colspan="2" class="total-line">
                                            <label>Due</label>
                                        </td>
                                        <td colspan="2" class="total-value">
                                            <input type="text" name="due"
                                                   class="form-control due-amount"
                                                   value="" readonly>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('method', 'Payment Method ', ['class' => 'col-form-label']); !!}
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="mdi mdi-credit-card"></i></span></div>

                                            {!! Form::select('method',config('constants.PAYMENT_METHODS'),null,['class' => 'form-control','placeholder'=>'Select payment method','id'=>'payment_method']); !!}

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('method', 'Payment Status', ['class' => 'col-form-label']); !!}
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="mdi mdi-check-box-outline"></i></span>
                                            </div>
                                            {!! Form::select('status',config('constants.PAYMENT_STATUS'),null,['class' => 'form-control','placeholder'=>'Select payment method','id'=>'payment_method']); !!}

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Seller Note</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="ti-quote-left"></i></span></div>
                                            <textarea class="form-control" name="note"
                                                      rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="panel-footer text-center">
                            <button type="submit" name="submit" class="btn btn-primary"><i
                                    class="ti-save-alt pr-2"></i> Save invoice
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

@endsection
@section('script')
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

    <script>
        var productOption = '';
        <?php if(!empty($products_with_size_data)) {foreach ($products_with_size_data as $key => $row){?>
            productOption += '<option value="<?php echo $row['product_name']?>" data-id="<?php echo json_encode($row['product_id'])?>" data-size=<?php echo json_encode($row['size'],JSON_UNESCAPED_UNICODE)?>><?php echo $row['product_name']?></option>';
        <?php }}?>

    </script>
    <script src="{{ URL::asset('/js/pages/seller-invoice.js')}}"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\SellerInvoiceRequest', '#seller-invoice-form'); !!}
@endsection
