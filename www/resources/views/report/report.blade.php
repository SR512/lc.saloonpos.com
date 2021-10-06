@extends('layouts.master')

@section('title') Report @endsection
@section('css')
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="stylesheet">
@endsection
@section('content')

    @component('common-components.breadcrumb',['li_1'=>['Dashboard'=>route('home')]])
        @slot('title') Report  @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <br/>
                    {!! Form::open(['url' => route('expense.report.index'),'id'=>'report-form','method'=>'post']) !!}

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('start_date', 'Start Date', ['class' => 'col-form-label']); !!}
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="mdi mdi-calendar"></i></span>
                                            </div>
                                            {!! Form::date('start_date',\Carbon\Carbon::now()->format('Y-m-d'),['class' => 'form-control']); !!}

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('end_date', 'End Date', ['class' => 'col-form-label']); !!}
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="mdi mdi-calendar"></i></span>
                                            </div>
                                            {!! Form::date('end_date',\Carbon\Carbon::now()->format('Y-m-d'),['class' => 'form-control']); !!}

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('report_type', 'Report Type', ['class' => 'col-form-label']); !!}
                                        <div class="input-group">
                                            {!! Form::select('report_type',['expense' => 'Expense','customer-invoice' => 'Customer Invoice','seller-invoice' => 'Seller Invoice','employee-commission'=>'Employee commission'],null,['class' => 'form-control','placeholder'=>'Select report']); !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('status', 'Payment Status', ['class' => 'col-form-label']); !!}
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="mdi mdi-check-box-outline"></i></span>
                                            </div>
                                            {!! Form::select('status',config('constants.PAYMENT_STATUS'),null,['class' => 'form-control','placeholder'=>'Select payment method','id'=>'payment_method']); !!}

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('employee_id', 'Employee', ['class' => 'col-form-label']); !!}
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="mdi mdi-check-box-outline"></i></span>
                                            </div>
                                            {!! Form::select('employee',$employees,null,['class' => 'form-control','placeholder'=>'Select Employee','id'=>'employee_id']); !!}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            <button type="submit" name="submit" class="btn btn-primary"><i
                                    class="ti-save-alt pr-2"></i> Genrate Report
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

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\ReportRequest', '#report-form'); !!}
@endsection
