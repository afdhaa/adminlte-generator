@extends('layouts_ubold.vertical', ['title' => 'Dashboard'])

@section('css')
<!-- Plugins css -->
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
<!-- Start Content-->
<div class="container-fluid">
    @include('flash::message')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="row" style="justify-content:space-between; margin:0px 10px 0px 10px;">
                <div class="page-title-box">
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-12 col-md-12 order-1">
            <div class="card">
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="deliveryharian"></div>
                        <p class="highcharts-description">
                        </p>
                    </figure>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row -->
</div>


@endsection

@section('script')
<!-- Plugins js-->
{{-- <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script> --}}
<script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- Page js-->
<script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
@endsection
