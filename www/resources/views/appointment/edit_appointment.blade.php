@extends('layouts.master')

@section('title') Edit Customer @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css"/>

@endsection
@section('content')

    @component('common-components.breadcrumb',['li_1'=>['Dashboard'=>route('home'),'Customer List' =>route('customer.index') ]])
        @slot('title') Edit Customer  @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <a  href="{{route('customers.index')}}" class="btn btn-primary btn-sm"><i
                                class="mdi mdi-arrow-left"></i> Back Customer List</a>
                    </div>
                    <div class="float-left">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    {!! Form::open(['url' => route('customers.update',$customer->id),'id'=>'edit-customer-form']) !!}
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('first_name', 'First name', ['class' => 'col-form-label']); !!}
                                {!! Form::text('first_name',$customer->first_name,['class' => 'form-control']); !!}
                                @error('first_name')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('last_name', 'Last name', ['class' => 'col-form-label']); !!}
                                {!! Form::text('last_name',$customer->last_name,['class' => 'form-control']); !!}
                                @error('last_name')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('email', 'Email', ['class' => 'col-form-label']); !!}
                                {!! Form::email('email',$customer->email,['class' => 'form-control']); !!}
                                @error('email')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('mobile_number', 'Mobile', ['class' => 'col-form-label']); !!}
                                {!! Form::number('mobile_number',$customer->mobile_number,['class' => 'form-control','max'=>'10']); !!}
                                @error('mobile_number')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('date_of_birth', 'Date of birth', ['class' => 'col-form-label']); !!}
                                {!! Form::date('date_of_birth', $customer->date_of_birth,['class' => 'form-control','max'=>date('Y-m-d',strtotime(\Carbon\Carbon::now()))]); !!}
                                @error('date_of_birth')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('date_of_anniversary', 'Date of anniversary', ['class' => 'col-form-label']); !!}
                                {!! Form::date('date_of_anniversary', $customer->date_of_anniversary,['class' => 'form-control','max'=>date('Y-m-d',strtotime(\Carbon\Carbon::now()))]); !!}
                                @error('date_of_anniversary')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('address', 'Address', ['class' => 'col-form-label']); !!}
                                {!! Form::textarea('address',$customer->address,['class' => 'form-control','rows'=>2]); !!}
                                @error('address')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('city','City', ['class' => 'col-form-label']); !!}
                                {!! Form::text('city',$customer->city,['class' => 'form-control','max'=>'10']); !!}
                                @error('city')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('pin_code', 'Pin code', ['class' => 'col-form-label']); !!}
                                {!! Form::number('pin_code',$customer->pin_code,['class' => 'form-control','max'=>'10']); !!}
                                @error('pin_code')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            {!! Form::submit('Update',['class'=>'btn btn-primary btn-md']) !!}
                            </div>
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
    {!! JsValidator::formRequest('App\Http\Requests\CustomerRequest', '#edit-customer-form'); !!}
@endsection
