@extends('layouts.master')

@section('title') New Attribute @endsection
@section('css')

@endsection
@section('content')

    @component('common-components.breadcrumb',['li_1'=>['Dashboard'=>route('home'),'Attribute List' =>route('attribute.index') ]])
        @slot('title') New Attribute  @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <a  href="{{route('customers.index')}}" class="btn btn-primary btn-sm"><i
                                class="mdi mdi-arrow-left"></i> Back Attribute List</a>
                    </div>
                    <div class="float-left">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    {!! Form::open(['url' => route('attributes.store'),'id'=>'attribute-form']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('name', 'Name', ['class' => 'col-form-label ']); !!}
                                {!! Form::text('name','',['class' => 'form-control col-md-6']); !!}
                                @error('name')
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
    {!! JsValidator::formRequest('App\Http\Requests\AttributeRequest', '#attribute-form'); !!}
@endsection
