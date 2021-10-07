@extends('layouts.master')

@section('title') Edit Product @endsection
@section('css')

@endsection
@section('content')

    @component('common-components.breadcrumb',['li_1'=>['Dashboard'=>route('home'),'Product List' =>route('product.index') ]])
        @slot('title') Edit Product  @endslot
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
                    {!! Form::open(['url' => route('products.update',$product->id),'id'=>'edit-product-form']) !!}
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('product_name', 'Product name', ['class' => 'col-form-label']); !!}
                                {!! Form::text('product_name',$product->product_name,['class' => 'form-control col-md-6']); !!}
                                @error('product_name')
                                <span style="color:red">
                                    {{$message}}
                               </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="col-form-label">Product Detail</label>
                            <table class="table mb-10 mt-2 medicine-table">
                                <thead>
                                <tr>
                                    <th>Size</th>
                                    <th>Qty</th>
                                    <th>Min Qty</th>
                                    <th>Purchase Price</th>
                                    <th>Price</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($product->stocks))
                                    @foreach($product->stocks as $key => $row)
                                        <tr class="item-row">
                                            <td>
                                                <select class="form-control product-size" name="product[detail][{{$key}}][size]"
                                                        required>
                                                    @if(!empty($sizes))
                                                        <option value="">Select size</option>
                                                        @foreach($sizes as $size)
                                                            <option value="{{$size->id}}" {{$row->attribute_size_id == $size->id ?'selected':''}}>{{$size->size}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td><input type="number" value="{{$row->quantity}}" class="form-control"
                                                       name="product[detail][{{$key}}][qty]" placeholder="Qty" required></td>
                                            <td><input type="number" value="{{$row->min_quantity}}" class="form-control"
                                                       name="product[detail][{{$key}}][min_Qty]" placeholder="Min Qty" required></td>
                                            <td><input type="number" value="{{$row->purchase_price}}" class="form-control"
                                                       name="product[detail][{{$key}}][purchase_price]" placeholder="Purchase Price"
                                                       required></td>
                                            <td><input type="number" value="{{$row->price}}" class="form-control"
                                                       name="product[detail][{{$key}}][price]" placeholder="Price" required></td>
                                            <td>
                                                <button class="btn btn-danger medicine-delete"><i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr>
                                    <td colspan="6">
                                        <span id="add-item" class="btn btn-success btn-sm"><i class="mdi mdi-plus"></i>Add Item</span>
                                    </td>

                                </tr>

                                </tbody>
                            </table>
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
    {!! JsValidator::formRequest('App\Http\Requests\ProductRequest', '#edit-product-form'); !!}

    <script>
        var option = null;
        <?php foreach ($sizes  as $size) { ?>
            option += '<option value="<?php echo $size['id']; ?>"><?php echo $size['size']; ?></option>';
        <?php } ?>
    </script>
    <!-- Datatable init js -->
    <script src="{{ URL::asset('/js/pages/product.js')}}"></script>

@endsection
