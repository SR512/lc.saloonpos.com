@extends('layouts.master')

@section('title') Edit Employee @endsection
@section('css')

@endsection
@section('content')

    @component('common-components.breadcrumb',['li_1'=>['Dashboard'=>route('home'),'Employee List' =>route('employee.index') ]])
        @slot('title') Edit Employee  @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <a  href="{{route('employee.index')}}" class="btn btn-primary btn-sm"><i
                                class="mdi mdi-arrow-left"></i> Back Employee List</a>
                    </div>
                    <div class="float-left">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    {!! Form::open(['url' => route('employees.update',$employee->id),'id'=>'edit-employee-form']) !!}
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('first_name', 'First name', ['class' => 'col-form-label']); !!}
                                {!! Form::text('first_name',$employee->first_name,['class' => 'form-control']); !!}
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
                                {!! Form::text('last_name',$employee->last_name,['class' => 'form-control']); !!}
                                @error('last_name')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('gender', 'Gender', ['class' => 'col-form-label']); !!}
                                {!! Form::select('gender',['MALE'=>'Male','FEMALE'=>'Female'],$employee->gender,['class' => 'form-control job_type','placeholder'=>'Select Gender']); !!}
                                @error('gender')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('email', 'Email', ['class' => 'col-form-label']); !!}
                                {!! Form::email('email',$employee->email,['class' => 'form-control']); !!}
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
                                {!! Form::number('mobile_number',$employee->mobile_number,['class' => 'form-control','min'=>'10']); !!}
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
                                {!! Form::date('date_of_birth',$employee->date_of_birth,['class' => 'form-control','max'=>date('Y-m-d',strtotime(\Carbon\Carbon::now()))]); !!}
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
                                {!! Form::date('date_of_anniversary',$employee->date_of_anniversary,['class' => 'form-control','max'=>date('Y-m-d',strtotime(\Carbon\Carbon::now()))]); !!}
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
                                {!! Form::textarea('address',$employee->address,['class' => 'form-control','rows'=>2]); !!}
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
                                {!! Form::text('city',$employee->city,['class' => 'form-control']); !!}
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
                                {!! Form::number('pin_code',$employee->pin_code,['class' => 'form-control','min'=>'6']); !!}
                                @error('pin_code')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('job', 'Job Type', ['class' => 'col-form-label']); !!}
                                {!! Form::select('job_type',['BOTH'=>'Both','BOTH'=>'Both','COMMISSION'=>'Commission','SALARIED'=>'Salaried'],$employee->job_type,['class' => 'form-control job_type','placeholder'=>'Select job type']); !!}
                                @error('job_type')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6" style="display: {{($employee->job_type == 'BOTH' || $employee->job_type == 'COMMISSION')?'block':'none'}};" id="commission_percentage">
                            <div class="form-group">
                                {!! Form::label('commission_percentage', 'Commission (%)', ['class' => 'col-form-label']); !!}
                                {!! Form::number('commission_percentage',$employee->commission_percentage,['class' => 'form-control commission_percentage']); !!}
                                @error('commission_percentage')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="display: {{($employee->job_type == 'BOTH' || $employee->job_type == 'SALARIED')?'block':'none'}};" id="salary">
                                {!! Form::label('salary', 'Salary', ['class' => 'col-form-label']); !!}
                                {!! Form::number('salary',$employee->salary,['class' => 'form-control salary']); !!}
                                @error('salary')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
    {!! JsValidator::formRequest('App\Http\Requests\EmployeeRequest', '#employee-form'); !!}
    <!-- Datatable init js -->
    <script src="{{ URL::asset('/js/pages/employee.js')}}"></script>
@endsection
