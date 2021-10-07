@extends('layouts.master')

@section('title') New Package @endsection
@section('css')

@endsection
@section('content')

    @component('common-components.breadcrumb',['li_1'=>['Dashboard'=>route('home'),'Package List' =>route('package.index') ]])
        @slot('title') New Package  @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <a href="{{route('package.index')}}" class="btn btn-primary btn-sm"><i
                                class="mdi mdi-arrow-left"></i> Back Package List</a>
                    </div>
                    <div class="float-left">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    {!! Form::open(['url' => route('packages.store'),'id'=>'package-form']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('packagename', 'Package name', ['class' => 'col-form-label']); !!}
                                {!! Form::text('packagename','',['class' => 'form-control']); !!}
                                @error('packagename')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('duration (Duration in Month)', 'Duration', ['class' => 'col-form-label']); !!}
                                {!! Form::number('duration','',['class' => 'form-control']); !!}
                                @error('duration')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="col-form-label">Package Detail</label>
                            <table class="table mb-10 mt-2 medicine-table">
                                <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Qty</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="item-row">
                                    <td>
                                        <select class="form-control product-size" name="product[detail][0][size]"
                                                required>
                                            @if(!empty($services))
                                                <option value="">Select size</option>
                                                @foreach($services as $service)
                                                    <option value="{{$service->service_name}}">{{$service->service_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td><input type="number" value="" class="form-control"
                                               name="product[detail][0][qty]" placeholder="Qty" required></td>
                                    <td>
                                        <button class="btn btn-danger medicine-delete"><i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <span id="add-item" class="btn btn-success btn-sm"><i class="mdi mdi-plus"></i>Add Item</span>
                                    </td>

                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('totalprice', 'Total price', ['class' => 'col-form-label']); !!}
                                {!! Form::number('totalprice','',['class' => 'form-control']); !!}
                                @error('totalprice')
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
    {!! JsValidator::formRequest('App\Http\Requests\PackageRequest', '#package-form'); !!}

    <script>
        var option = null;
        <?php foreach ($services  as $service) { ?>
            option += '<option value="<?php echo $service['service_name']; ?>"><?php echo $service['service_name']; ?></option>';
        <?php } ?>
    </script>
    <!-- Datatable init js -->
    <script src="{{ URL::asset('/js/pages/package.js')}}"></script>

@endsection
