@extends('layouts.master')

@section('title') Show Package @endsection
@section('css')

@endsection
@section('content')

    @component('common-components.breadcrumb',['li_1'=>['Dashboard'=>route('home'),'Package List' =>route('package.index') ]])
        @slot('title') Show Package  @endslot
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
                    <div class="row">
                        <div class="card col-md-12">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <h5 class="card-title mb-3">Package name</h5>
                                    <p class="card-title-desc">
                                        {{$package->packagename}}
                                    </p>
                                    <h5 class="card-title mb-3">Package Duration</h5>
                                    <p class="card-title-desc">
                                        {{$package->duration}}
                                    </p>
                                    <h5 class="card-title mb-3">Package price</h5>
                                    <p class="card-title-desc">
                                        {{$package->totalprice}}
                                    </p>

                                    <h5 class="card-title mb-3">Package Detail</h5>
                                    <table class="table mb-10 mt-2 medicine-table">
                                        <thead>
                                        <tr>
                                            <th>Service</th>
                                            <th>Qty</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($package->packagedetail))
                                            @foreach(json_decode($package->packagedetail) as $key => $row)
                                                <tr>
                                                    <td>{{$row->size}}</td>
                                                    <td>{{$row->qty}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

@endsection

