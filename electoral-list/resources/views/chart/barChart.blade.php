@extends('layouts.base')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('vuexy/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css ' )}}">

@endsection
@section('content')

<div class="col-xl-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                    <div class="header-left">
                                        <h4 class="card-title">Latest Statistics</h4>
                                    </div>
                                    <div class="header-right d-flex align-items-center mt-sm-0 mt-1">
                                        <i data-feather="calendar"></i>
                                        <input type="text" class="form-control flat-picker border-0 shadow-none bg-transparent pr-0" placeholder="YYYY-MM-DD" />
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas class="bar-chart-ex chartjs" data-height="400"></canvas>
                                </div>
                            </div>
</div>
                        <!-- Bar Chart End -->
 @endsection


 @section('js')

 <script src="{{asset('vuexy/app-assets/vendors/js/charts/chart.min.js ' ) }}"></script>
 <script src="{{asset('vuexy/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js' ) }}"></script>
  <script src="{{asset('vuexy/app-assets/js/scripts/charts/chart-chartjs.js') }}"></script>
   @endsection