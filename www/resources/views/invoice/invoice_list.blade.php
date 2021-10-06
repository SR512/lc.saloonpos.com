@extends('layouts.master')

@section('title') Invoice List @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css"/>

@endsection
@section('content')

    @component('common-components.breadcrumb',['li_1'=>['Dashboard'=>route('home')]])
        @slot('title') Invoice List  @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <a  href="{{route('invoices.create')}}" class="btn btn-primary btn-sm"><i
                                class="mdi mdi-note"></i> New Invoice</a>
                    </div>
                    <div class="float-left">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    <table id="datatable-invoice" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Invoice Date</th>
                            <th>Customer Detail</th>
                            <th>Amount</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Status</th>
                            <th>Method</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
@endsection
@section('script')

    <!-- Required datatable js -->
    <script src="{{ URL::asset('/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{ URL::asset('/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{ URL::asset('/libs/pdfmake/pdfmake.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{ URL::asset('/js/pages/invoice.js')}}"></script>

@endsection
