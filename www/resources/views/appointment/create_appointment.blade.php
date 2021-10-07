@extends('layouts.master')

@section('title') New Appointment @endsection
@section('css')

@endsection
@section('content')

    @component('common-components.breadcrumb',['li_1'=>['Dashboard'=>route('home'),'Appointment List' =>route('appointment.index') ]])
        @slot('title') New Appointment  @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <a  href="{{route('appointment.index')}}" class="btn btn-primary btn-sm"><i
                                class="mdi mdi-arrow-left"></i> Back Appointment List</a>
                    </div>
                    <div class="float-left">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    {!! Form::open(['url' => route('appointments.store'),'id'=>'appointment-form']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('customer_id', 'Customer', ['class' => 'col-form-label']); !!}
                                {!! Form::select('customer_id',$customers,null,['class' => 'form-control','placeholder'=>'Select customer']); !!}
                                @error('first_name')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('service_id', 'Service', ['class' => 'col-form-label']); !!}
                                {!! Form::select('service_id',$services,null,['class' => 'form-control','placeholder'=>'Select service']); !!}
                                @error('service_id')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('employee_id', 'Employee', ['class' => 'col-form-label']); !!}
                                {!! Form::select('employee_id',$employees,null,['class' => 'form-control','placeholder'=>'Select employee']); !!}
                                @error('first_name')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('appointment_date_time', 'Date', ['class' => 'col-form-label']); !!}
                                {!! Form::datetimeLocal('appointment_date_time','',['class' => 'form-control','max'=>date('Y-m-d',strtotime(\Carbon\Carbon::now()))]); !!}
                                @error('date_of_birth')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                            {!! Form::submit('Save',['class'=>'btn btn-primary btn-md']) !!}
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
    {!! JsValidator::formRequest('App\Http\Requests\AppointmentRequest', '#appointment-form'); !!}
@endsection
