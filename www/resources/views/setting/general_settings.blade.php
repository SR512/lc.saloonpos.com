@extends('layouts.master')

@section('title') Settings @endsection
@section('css')

@endsection
@section('content')

    @component('common-components.breadcrumb',['li_1'=>['Dashboard'=>route('home')]])
        @slot('title') Settings  @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-left">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    @if(empty($settings))
                        {{Form::open(['url'=> route('settings.store'),'method'=>'post','id'=>'setting-form','files' => true])}}
                    @else
                        {{Form::open(['url'=> route('settings.update',$settings->id),'method'=>'post','id'=>'setting-form','files' => true])}}
                        @method('PATCH')
                    @endif
                    <div class="row">
                        @if(!empty($settings->site_logo))
                            <div class="col-md-12 mb-5">
                                @php($filedir = config('constants.SITE_LOGO_URI'))
                                <img src="{{asset($filedir . $settings->site_logo)}}" width="300px">
                            </div>
                        @endif
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('site_logo', null, ['class' => 'col-form-label']) }}
                                {{Form::file('site_logo',['class'=>'form-control'])}}
                                @error('site_logo')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('name', null, ['class' => 'col-form-label']) }}
                                {{Form::text('name',$settings->name??null,['class'=>'form-control'])}}
                                @error('name')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('GST No', null, ['class' => 'col-form-label']) }}
                                {{Form::text('gst',$settings->gst??null,['class'=>'form-control'])}}
                                @error('gst')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('email', null, ['class' => 'col-form-label']) }}
                                {{Form::text('email',$settings->email??null,['class'=>'form-control'])}}
                                @error('email')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('mobile', null, ['class' => 'col-form-label']) }}
                                {{Form::text('mobile',$settings->mobile??null,['class'=>'form-control'])}}
                                @error('mobile')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                {{ Form::label('address', null, ['class' => 'ccol-form-label']) }}
                                {{Form::textarea('address',$settings->address ?? null,['class'=>'form-control','id'=>'address','rows'=>2])}}
                                @error('address')
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
                    {{Form::close()}}
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\SettingRequest', '#setting-form'); !!}
@endsection
