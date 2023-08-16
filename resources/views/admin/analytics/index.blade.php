@extends('admin.layout.main')

@section('content')

    <?php
    echo date('F, Y');
    for ($i = 12; $i > 0; $i--) {
        $month[] = date('M-Y', strtotime("-$i month"));
    }

    $months = json_encode($month);

    ?>

    <input type="hidden" value="{{$months}}" name="months" id="months">


    <style>
        table.dataTable {
            margin-top: 0px !important;

        }

        #regions_div {
            height: 450px;
        }

        #donut_single {
            height: 380px;
        }

    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['geochart', 'corechart'],
            // Note: you will need to get a mapsApiKey for your project.
            // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
            'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
        });
        google.charts.setOnLoadCallback(drawRegionsMap);


        function drawRegionsMap() {
            var data = google.visualization.arrayToDataTable(
                    {!! $country !!}
            );
            var options = {
                colorAxis: {colors: ['#00853f', 'black', '#e31b23']}
            };

            var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

            chart.draw(data, options);


            var data1 = google.visualization.arrayToDataTable(
                {!! $devices !!}
            );

            var options1 = {
                pieHole: 0.5,
                pieSliceTextStyle: {
                    color: 'black',
                },
                legend: 'none'
            };

            var chart1 = new google.visualization.PieChart(document.getElementById('donut_single'));
            chart1.draw(data1, options1);


        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script>
        $(function () {
            var ctx = document.getElementById('line_div').getContext('2d');
            var chartas = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',

                // The data for our dataset
                data: {
                    labels: {!! $mobileUsersDate !!},
                    datasets: [{
                        label: 'Users',
                        fill: false,
                        borderColor: 'rgb(255, 99, 132)',
                        data: {!! $mobileUser !!}
                    }]
                },

                // Configuration options go here
                options: {}
            });
        });
    </script>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <h1 class="m-0 text-dark">Google Analytics</h1>
                    </div>
                    <!-- /.col -->


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date range:</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                                </div>
                                <input type="text" class="form-control float-right" id="dateRange">

                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Filter:</label>
                        <select name="date_filter" class="form-control float-right"
                                onchange="window.location.href = '?days='+$(this).val()">
                            <option value="7" @if(isset($_GET['days']) && $_GET['days'] == 7) selected @endif>Last 7
                                Days
                            </option>
                            <option value="28" @if(isset($_GET['days']) && $_GET['days'] == 28) selected @endif>Last 28
                                Days
                            </option>
                            <option value="90" @if(isset($_GET['days']) && $_GET['days'] == 90) selected @endif>Last 90
                                Days
                            </option>
                            <option value="120" @if(isset($_GET['days']) && $_GET['days'] == 120) selected @endif>Last 120
                                Days
                            </option>
                            <option value="150" @if(isset($_GET['days']) && $_GET['days'] == 150) selected @endif>Last 5
                                Months
                            </option>
                        </select>
                    </div>
                    <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">


                                <div class="row">

                                    <div class="col-12">
                                        <h4 class="float-left box-heading"><i class="fas fa-users fa-warning"></i>
                                            All Users</h4>
                                        <p class="float-right">
                                        </p>
                                        <h1 class="float-right">{{$users->totalsForAllResults['ga:users']}}</h1>
                                        <p></p>
                                    </div>

                                    <div class="col-12 bordered-div"></div>
                                    <div class="col">
                                        <span class="info-box-number">
                                          <h1>{{$returnedUsers->rows[1][1] ?? '0'}}</h1>
                                        </span>
                                        <p class="info-box-text text-green font-12"><b>Returning Users</b></p>
                                    </div>
                                    <div class="col text-right">
                                            <span class="info-box-number">
                                                <h1>
{{$returnedUsers->rows[0][1] ?? '0'}}</h1>

                                                                                            </span>
                                        <p class="info-box-text text-green font-12"><b> New Users</b></p>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>


                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Sessions</span>
                                <span class="info-box-number"><h1>
                                  {{$sessions->totalsForAllResults['ga:sessions']}}</h1>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">New Users</span>
                                @php
                                    $seconds = $sessionDuration->totalsForAllResults['ga:avgSessionDuration'] ;
                                    $hours = floor($seconds / 3600);
                                    $seconds -= $hours * 3600;
                                    $minutes = floor($seconds / 60);
                                    $seconds -= $minutes * 60;
                                @endphp
                                <span class="info-box-number">
                                    <h1>{{$minutes.'m '. number_format((float)$seconds, 0, '.', '').'s' }}
                                    </h1></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <!-- /.col -->

                {{--                    <div class="col-12 col-sm-6 col-md-3">--}}
                {{--                        <div class="info-box mb-3">--}}
                {{--                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>--}}

                {{--                            <div class="info-box-content">--}}
                {{--                                <span class="info-box-text">Returning Users</span>--}}
                {{--                                <span class="info-box-number">{{$returnedUsers->rows[1][1]}}</span>--}}
                {{--                            </div>--}}
                {{--                            <!-- /.info-box-content -->--}}
                {{--                        </div>--}}
                {{--                        <!-- /.info-box -->--}}
                {{--                    </div>--}}
                <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i
                                        class="fas fa-level-up-alt"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Bounce Rate</span>
                                <span class="info-box-number">
                                    <h1>{{number_format((float)$bounce_rate->totalsForAllResults['ga:bounceRate'], 2, '.', '')}}%
                                    </h1></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->
                <div class="row">
                    <!-- Left col -->
                    <div class="col-md-12">


                        <!-- TABLE: LATEST ORDERS -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Where are your users?</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                                class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <canvas id="line_div" style="height: 400px;width: 100%"></canvas>
                         </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-4">


                        <!-- TABLE: LATEST ORDERS -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Where are your users?</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                                class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div id="regions_div"></div>

                            <div class="text-right"><a href="{{url('admin/location-overview')}}">Location Overview </a>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-4">


                        <!-- TABLE: LATEST ORDERS -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">What are your top devices?</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                                class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div id="donut_single"></div>
                            <div class="row text-center">
                                <div class="col-sm-6"><i class="fa fa-laptop" aria-hidden="true"></i></div>
                                <div class="col-sm-6"><i class="fa fa-mobile" aria-hidden="true"></i></div>
                                <div class="col-sm-6">Desktop</div>
                                <div class="col-sm-6">Mobile</div>
                                <div class="col-sm-6">{{$devicess[0][1] ?? '0'}}</div>
                                <div class="col-sm-6">{{$devicess[1][1] ?? '0'}}</div>
                            </div>
                            <div class="text-right"><a href="{{url('admin/mobile-overview')}}">Mobile Overview </a>
                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->


                </div>

                <div class="row " style="display:none;">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Monthly Recap Report</h5>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-tool dropdown-toggle"
                                                data-toggle="dropdown">
                                            <i class="fas fa-wrench"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                                            <a href="#" class="dropdown-item">Action</a>
                                            <a href="#" class="dropdown-item">Another action</a>
                                            <a href="#" class="dropdown-item">Something else here</a>
                                            <a class="dropdown-divider"></a>
                                            <a href="#" class="dropdown-item">Separated link</a>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="text-center">
                                            <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                        </p>

                                        <div class="chart">
                                            <!-- Sales Chart Canvas -->
                                            <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                                        </div>
                                        <!-- /.chart-responsive -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-4">
                                        <p class="text-center">
                                            <strong>Goal Completion</strong>
                                        </p>

                                        <div class="progress-group">
                                            Add Products to Cart
                                            <span class="float-right"><b>160</b>/200</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-primary" style="width: 80%"></div>
                                            </div>
                                        </div>
                                        <!-- /.progress-group -->

                                        <div class="progress-group">
                                            Complete Purchase
                                            <span class="float-right"><b>310</b>/400</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-danger" style="width: 75%"></div>
                                            </div>
                                        </div>

                                        <!-- /.progress-group -->
                                        <div class="progress-group">
                                            <span class="progress-text">Visit Premium Page</span>
                                            <span class="float-right"><b>480</b>/800</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-success" style="width: 60%"></div>
                                            </div>
                                        </div>

                                        <!-- /.progress-group -->
                                        <div class="progress-group">
                                            Send Inquiries
                                            <span class="float-right"><b>250</b>/500</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-warning" style="width: 50%"></div>
                                            </div>
                                        </div>
                                        <!-- /.progress-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- ./card-body -->
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-3 col-6">
                                        <div class="description-block border-right">
                                            <span class="description-percentage text-success"><i
                                                        class="fas fa-caret-up"></i> 17%</span>
                                            <h5 class="description-header">$35,210.43</h5>
                                            <span class="description-text">TOTAL REVENUE</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3 col-6">
                                        <div class="description-block border-right">
                                            <span class="description-percentage text-warning"><i
                                                        class="fas fa-caret-left"></i> 0%</span>
                                            <h5 class="description-header">$10,390.90</h5>
                                            <span class="description-text">TOTAL COST</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3 col-6">
                                        <div class="description-block border-right">
                                            <span class="description-percentage text-success"><i
                                                        class="fas fa-caret-up"></i> 20%</span>
                                            <h5 class="description-header">$24,813.53</h5>
                                            <span class="description-text">TOTAL PROFIT</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3 col-6">
                                        <div class="description-block">
                                            <span class="description-percentage text-danger"><i
                                                        class="fas fa-caret-down"></i> 18%</span>
                                            <h5 class="description-header">1200</h5>
                                            <span class="description-text">GOAL COMPLETIONS</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>


                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <div class="col-md-6">


                        <!-- TABLE: LATEST ORDERS -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">What pages do your users visit?</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                                class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0" id="example1">
                                        <thead>
                                        <tr>
                                            <th>Page</th>
                                            <th> Page Views</th>
                                            <th> Page Value</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($visitedPages as $visitedPage)
                                            <tr>
                                                <td>
                                                    <a href="{{url($visitedPage['url'])}}">{{Str::limit($visitedPage['pageTitle'],20)}}</a>
                                                </td>
                                                <td>{{$visitedPage['pageViews']}}</td>
                                                <td>${{$visitedPage['pageValue']}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="text-right"><a href="{{url('admin/pages-report')}}">Pages Report </a>
                                </div>
                                <!-- /.table-responsive -->
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <!-- Left col -->
                    </div>
                    <div class="col-md-6">


                        <!-- TABLE: LATEST ORDERS -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Most Viewed Pages & Users</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                                class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0" id="example2">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Page Title</th>
                                            <th>Views</th>
                                            <th>Visitors</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pagevisitors as $pagevisitor)
                                            <tr>
                                                <td>{{$pagevisitor['date']->diffForHumans()}}</td>
                                                <td title="{{$pagevisitor['pageTitle']}}">
                                                    @if($pagevisitor['pageTitle'] == '(not set)')
                                                        /
                                                    @else
                                                        <a href="{{url($pagevisitor['pageURL'])}}">{{Str::limit($pagevisitor['pageTitle'],20)}}</a>
                                                </td>
                                                @endif
                                                <td>{{$pagevisitor['pageViews']}}</td>
                                                <td>{{$pagevisitor['visitors']}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <!-- Info Boxes Style 2 -->


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Browser Sessions</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                                class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="chart-responsive">
                                            <canvas id="pieChart" height="150"></canvas>
                                        </div>
                                        <!-- ./chart-responsive -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-5">
                                        <ul class="chart-legend clearfix">
                                            @php $colors = explode(",",charts_colors()); @endphp
                                            @foreach($topBrowsers_names as $key => $browsers_name)
                                                <li><i class="far fa-circle"
                                                       style="color: {{str_replace("'",'',$colors[$key])}};"></i> {{$browsers_name}}
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-body -->

                            <!-- /.footer -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <div class="col-md-6">
                        <!-- PRODUCT LIST -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Top Referrers Websites</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table m-0" id="example3">
                                        <thead>
                                        <tr>

                                            <th>Website Names</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($refererrs as $refererr)
                                            <tr>
                                                @php $parse_url = parse_url($refererr['url']);  @endphp
                                                <td title="{{$refererr['url']}}">

                                                    <a href="http://{{$refererr['url']}}">{{$parse_url['host'] ?? $parse_url['path']}}</a>
                                                    <span class="badge badge-primary float-right">{{$refererr['pageViews']}}</span>
                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                        <!-- /.card -->
                    </div>

                    <!-- /.col -->

                </div>

                <!-- /.row -->


            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <script>
        $(document).on("click", ".applyBtn", function () {
            var between = $('#dateRange').val();

            var date = between.split(' - ');
            var startDate = date[0];
            var endDate = date[1];

console.log(startDate)
console.log(endDate)
            window.location.href = '?startDate=' + startDate + '&endDate=' + endDate
        });

        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "lengthChange": false,
                "searching": false,
                pageLength: 5,

            });
            $('#dateRange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                }
            })
            //Date range picker with time picker


            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                pageLength: 5,
            });
            $('#example3').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                pageLength: 5,
            });
            $('#example4').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                pageLength: 5,
            });

        });

        var labels_here = [ {!! $topBrowsers !!} ];
        var data_browser_here = [ {!! $topBrowsers_data !!} ];
        var background_color_donut = [ {!! charts_colors() !!} ];
    </script>


@endsection