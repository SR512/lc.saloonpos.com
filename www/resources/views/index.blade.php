@extends('layouts.master')

@section('title') Dashboard @endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Dashboard   @endslot
        @slot('title_li') Welcome to {{config('constants.APP_NAME')}} Dashboard   @endslot
    @endcomponent

    <div class="row">

        @component('common-components.dashboard-widget')

            @slot('title') Customer  @endslot
            @slot('iconClass') mdi mdi-account-multiple-outline  @endslot
            @slot('price') {{$customers}}  @endslot

        @endcomponent
        @component('common-components.dashboard-widget')

            @slot('title') Employee  @endslot
            @slot('iconClass') mdi mdi-account-multiple-outline  @endslot
            @slot('price') {{$employees}}  @endslot
        @endcomponent

        @component('common-components.dashboard-widget')

            @slot('title') Today's Customer Sales  @endslot
            @slot('iconClass') mdi mdi-account-multiple-outline  @endslot
            @slot('price')  {{$todaysCustomerSales}} @endslot
        @endcomponent


        @component('common-components.dashboard-widget')

            @slot('title') Today's Seller Sales  @endslot
            @slot('iconClass') mdi mdi-account-multiple-outline  @endslot
            @slot('price')  {{$todaysSalllerSales}} @endslot
        @endcomponent

        @component('common-components.dashboard-widget')

            @slot('title') Today's Customer Due  @endslot
            @slot('iconClass') mdi mdi-account-multiple-outline  @endslot
            @slot('price')  {{$todaysCustomeDue}}  @endslot
        @endcomponent
        @component('common-components.dashboard-widget')

            @slot('title') Today's Seller Due  @endslot
            @slot('iconClass') mdi mdi-account-multiple-outline  @endslot
            @slot('price')  {{$todaysSalllerDue}}  @endslot
        @endcomponent
    </div>
    <div class="row">
        {{--        <div class="col-lg-4">--}}
        {{--            <div class="card">--}}
        {{--                <div class="card-body">--}}
        {{--                    <h4 class="card-title mb-4">Inbox</h4>--}}

        {{--                    <ul class="inbox-wid list-unstyled">--}}
        {{--                        <li class="inbox-list-item">--}}
        {{--                            <a href="#">--}}
        {{--                                <div class="media">--}}
        {{--                                    <div class="mr-3 align-self-center">--}}
        {{--                                        <img src="images/users/avatar-3.jpg" alt=""--}}
        {{--                                             class="avatar-sm rounded-circle">--}}
        {{--                                    </div>--}}
        {{--                                    <div class="media-body overflow-hidden">--}}
        {{--                                        <h5 class="font-size-16 mb-1">Paul</h5>--}}
        {{--                                        <p class="text-truncate mb-0">Hey! there I'm available</p>--}}
        {{--                                    </div>--}}
        {{--                                    <div class="font-size-12 ml-2">--}}
        {{--                                        05 min--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                            </a>--}}
        {{--                        </li>--}}
        {{--                        <li class="inbox-list-item">--}}
        {{--                            <a href="#">--}}
        {{--                                <div class="media">--}}
        {{--                                    <div class="mr-3 align-self-center">--}}
        {{--                                        <img src="images/users/avatar-4.jpg" alt=""--}}
        {{--                                             class="avatar-sm rounded-circle">--}}
        {{--                                    </div>--}}
        {{--                                    <div class="media-body overflow-hidden">--}}
        {{--                                        <h5 class="font-size-16 mb-1">Mary</h5>--}}
        {{--                                        <p class="text-truncate mb-0">This theme is awesome!</p>--}}
        {{--                                    </div>--}}
        {{--                                    <div class="font-size-12 ml-2">--}}
        {{--                                        12 min--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                            </a>--}}
        {{--                        </li>--}}
        {{--                        <li class="inbox-list-item">--}}
        {{--                            <a href="#">--}}
        {{--                                <div class="media">--}}
        {{--                                    <div class="mr-3 align-self-center">--}}
        {{--                                        <img src="images/users/avatar-5.jpg" alt=""--}}
        {{--                                             class="avatar-sm rounded-circle">--}}
        {{--                                    </div>--}}
        {{--                                    <div class="media-body overflow-hidden">--}}
        {{--                                        <h5 class="font-size-16 mb-1">Cynthia</h5>--}}
        {{--                                        <p class="text-truncate mb-0">Nice to meet you</p>--}}
        {{--                                    </div>--}}
        {{--                                    <div class="font-size-12 ml-2">--}}
        {{--                                        18 min--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                            </a>--}}
        {{--                        </li>--}}
        {{--                        <li class="inbox-list-item">--}}
        {{--                            <a href="#">--}}
        {{--                                <div class="media">--}}
        {{--                                    <div class="mr-3 align-self-center">--}}
        {{--                                        <img src="images/users/avatar-6.jpg" alt=""--}}
        {{--                                             class="avatar-sm rounded-circle">--}}
        {{--                                    </div>--}}
        {{--                                    <div class="media-body overflow-hidden">--}}
        {{--                                        <h5 class="font-size-16 mb-1">Darren</h5>--}}
        {{--                                        <p class="text-truncate mb-0">I've finished it! See you so</p>--}}
        {{--                                    </div>--}}
        {{--                                    <div class="font-size-12 ml-2">--}}
        {{--                                        2hr ago--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                            </a>--}}
        {{--                        </li>--}}
        {{--                    </ul>--}}

        {{--                    <div class="text-center">--}}
        {{--                        <a href="#" class="btn btn-primary btn-sm">Load more</a>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Stock</h4>

                    <div class="table-responsive">
                        <table class="table table-centered">
                            <thead>
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Size</th>
                                <th scope="col">Qty</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($products_with_size_data) != 0)
                                @foreach($products_with_size_data as $rowProduct)
                                    @foreach($rowProduct['size'] as $rowSize)
                                        <tr>
                                            <td>{{$rowProduct['product_name']}}</td>
                                            <td>{{$rowSize['size']}}</td>
                                            <td>{{$rowSize['quantity']}}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">No data found.</td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Today's Customer Birthday</h4>

                    <div class="table-responsive">
                        <table class="table table-centered">
                            <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Mobile</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($todaysCustomerBirthday) != 0)
                                @foreach($todaysCustomerBirthday as $row)
                                    <tr>
                                        <td>{{$row->date_of_birth_formatted}}</td>
                                        <td>{{$row->full_name}}</td>
                                        <td>{{$row->mobile_number}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">No data found.</td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Today's Employee Birthday</h4>

                    <div class="table-responsive">
                        <table class="table table-centered">
                            <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Mobile</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($todaysEmployeeBirthday) != 0)
                                @foreach($todaysEmployeeBirthday as $row)
                                    <tr>
                                        <td>{{$row->date_of_birth_formatted}}</td>
                                        <td>{{$row->full_name}}</td>
                                        <td>{{$row->mobile_number}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">No data found.</td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('script')
    <!-- plugin js -->
    <script src="{{ URL::asset('libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- jquery.vectormap map -->
    <script src="{{ URL::asset('libs/jquery-vectormap/jquery-vectormap.min.js')}}"></script>

    <!-- Calendar init -->
    <script src="{{ URL::asset('js/pages/dashboard.init.js')}}"></script>
@endsection
