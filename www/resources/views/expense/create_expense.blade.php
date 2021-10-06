@extends('layouts.master')

@section('title') New Expense @endsection
@section('css')

@endsection
@section('content')

    @component('common-components.breadcrumb',['li_1'=>['Dashboard'=>route('home'),'Customer List' =>route('customer.index') ]])
        @slot('title') New Expense  @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <a  href="{{route('expense.index')}}" class="btn btn-primary btn-sm"><i
                                class="mdi mdi-arrow-left"></i> Back Expense List</a>
                    </div>
                    <div class="float-left">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    {!! Form::open(['url' => route('expenses.store'),'id'=>'expense-form']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('expenses_name', 'Expenses name', ['class' => 'col-form-label']); !!}
                                {!! Form::text('expenses_name','',['class' => 'form-control']); !!}
                                @error('expenses_name')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('date', 'Date', ['class' => 'col-form-label']); !!}
                                {!! Form::date('date','',['class' => 'form-control','max'=>date('Y-m-d',strtotime(\Carbon\Carbon::now()))]); !!}
                                @error('date')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('amount', 'Amount', ['class' => 'col-form-label']); !!}
                                {!! Form::number('amount','',['class' => 'form-control','max'=>'10']); !!}
                                @error('pin_code')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::submit('Save',['class'=>'btn btn-primary btn-md']) !!}
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
    {!! JsValidator::formRequest('App\Http\Requests\ExpenseRequest', '#expense-form'); !!}
@endsection
