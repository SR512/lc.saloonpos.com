@extends('layouts.master')

@section('title') Show Membership @endsection
@section('css')

@endsection
@section('content')

    @component('common-components.breadcrumb',['li_1'=>['Dashboard'=>route('home'),'Membership List' =>route('membership.index') ]])
        @slot('title') Show Membership  @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <a href="{{route('membership.index')}}" class="btn btn-primary btn-sm"><i
                                class="mdi mdi-arrow-left"></i> Back Membership List</a>
                    </div>
                    <div class="float-left">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title mb-3">Customer name</h5>
                                <p class="card-title-desc">
                                    {{$membership->customers->full_name}}
                                </p>
                                <h5 class="card-title mb-3">Customer mobile</h5>
                                <p class="card-title-desc">
                                    {{$membership->customers->mobile_number}}
                                </p>
                                <h5 class="card-title mb-3">Package name</h5>
                                <p class="card-title-desc">
                                    {{$membership->packages->packagename}}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="card-title-desc">
                                <h5 class="card-title mb-3">Membership no</h5>
                                {{$membership->membership_no}}
                                </p>
                                <h5 class="card-title mb-3">Package Date</h5>
                                <p class="card-title-desc">
                                    {{$membership->created_at_formatted}}
                                </p>
                                <h5 class="card-title mb-3">Package Expire</h5>
                                <p class="card-title-desc">
                                    {{$membership->end_date_at_formatted}}
                                </p>
                                <h5 class="card-title mb-3">Package price</h5>
                                <p class="card-title-desc">
                                    {{$membership->packages->totalprice}}
                                </p>

                            </div>
                            <div class="col-md-12">
                                <h5 class="card-title mb-3">Package Detail</h5>
                                <table class="table mb-10 mt-2 medicine-table">
                                    <thead>
                                    <tr>
                                        <th>Service</th>
                                        <th>Qty</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($membership->packagedetail))
                                        @foreach(json_decode($membership->packagedetail) as $key => $row)
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
            </div>
        </div>
        <!-- end col -->
    </div>

@endsection
