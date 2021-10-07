@extends('layouts.master')

@section('title') Show Product @endsection
@section('css')

@endsection
@section('content')

    @component('common-components.breadcrumb',['li_1'=>['Dashboard'=>route('home'),'Product List' =>route('product.index') ]])
        @slot('title') Show Product  @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <a href="{{route('product.index')}}" class="btn btn-primary btn-sm"><i
                                class="mdi mdi-arrow-left"></i> Back Product List</a>
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
                                    <h5 class="card-title mb-3">Product name</h5>
                                    <p class="card-title-desc">
                                        {{$product->product_name}}
                                    </p>

                                    <h5 class="card-title mb-3">Product Detail</h5>
                                    <table class="table mb-10 mt-2 medicine-table">
                                        <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Qty</th>
                                            <th>Min Qty</th>
                                            <th>Purchase Price</th>
                                            <th>Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($product->stocks))
                                            @foreach($product->stocks as $key => $row)
                                                <tr>
                                                    <td>{{$row->attribute_size->size}}</td>
                                                    <td>{{$row->quantity}}</td>
                                                    <td>{{$row->min_quantity}}</td>
                                                    <td>{{$row->purchase_price}}</td>
                                                    <td>{{$row->price}}</td>
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

