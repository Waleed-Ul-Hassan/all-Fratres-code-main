@extends('admin.layout.main')

@section('content')
    <style>
        #regions_div {
            height: 400px; /* The height is 400 pixels */
            width: 100%; /* The width is the width of the web page */
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['geochart'],
            // Note: you will need to get a mapsApiKey for your project.
            // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
            'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
        });
        google.charts.setOnLoadCallback(drawMarkersMap);


        function drawMarkersMap() {
            var data = google.visualization.arrayToDataTable(
                    {!! $cities !!}
            );
            var options = {
                colorAxis: {colors: ['#00853f', 'black', '#e31b23']}
            };

            var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

            chart.draw(data, options);
        }
    </script>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">

                <div class="row">
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
                    <div class="col-md-12">


                        <!-- TABLE: LATEST ORDERS -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Map Overlay</h3>

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
                        </div>
                        <!-- /.card -->
                    </div>


                    <div class="col-md-12">


                        <!-- TABLE: LATEST ORDERS -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Location Overview</h3>

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
                                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6"></div>
                                            <div class="col-sm-12 col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table m-0 dataTable no-footer dtr-inline" id="example2"
                                                       role="grid" aria-describedby="example2_info">
                                                    <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1" aria-sort="ascending"
                                                            aria-label="Date: activate to sort column descending">City
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Page Title: activate to sort column ascending">
                                                            Users
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Views: activate to sort column ascending">New
                                                            Users
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Visitors: activate to sort column ascending">
                                                            Sessions
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Visitors: activate to sort column ascending">
                                                            Bounce Rate
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Visitors: activate to sort column ascending">
                                                            Pages / Session
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Visitors: activate to sort column ascending">
                                                            Avg. Session Duration
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <thead>
                                                    <tr role="row">
                                                        <th></th>
                                                        <th class="text-right"> {{$city->totalsForAllResults['ga:users']}}
                                                            <br>
                                                            <small>% of Total:<br> 100.00%
                                                                ({{$city->totalsForAllResults['ga:users']}})</small>
                                                        </th>
                                                        <th>{{$city->totalsForAllResults['ga:newUsers']}}
                                                            <br>
                                                            <small>% of Total:<br> 100.00%
                                                                ({{$city->totalsForAllResults['ga:newUsers']}})</small>
                                                        </th>
                                                        <th>{{$city->totalsForAllResults['ga:sessions']}}
                                                            <br>
                                                            <small>% of Total:<br> 100.00%
                                                                ({{$city->totalsForAllResults['ga:sessions']}})</small>
                                                        </th>
                                                        <th> {{number_format((float)$city->totalsForAllResults['ga:bounceRate'], 2, '.', '') }}
                                                            <br>
                                                            <small>% of Total:<br> 100.00%
                                                                ({{$city->totalsForAllResults['ga:bounceRate']}}
                                                                )</small>
                                                        </th>
                                                        <th>{{number_format((float)$city->totalsForAllResults['ga:pageviewsPerSession'], 2, '.', '') }}
                                                            <br>
                                                            <small>% of Total:<br> 100.00%
                                                                ({{$city->totalsForAllResults['ga:pageviewsPerSession']}}
                                                                )</small>
                                                        </th>
                                                        <th>{{number_format((float)$city->totalsForAllResults['ga:avgSessionDuration'], 2, '.', '') }}
                                                            <br>
                                                            <small>% of Total:<br> 100.00%
                                                                ({{$city->totalsForAllResults['ga:avgSessionDuration']}}
                                                                )</small>
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($city as $cities)

                                                        <tr role="row" class="text-center">
                                                            <td class="sorting_1" tabindex="0">{{$cities[1]}}</td>
                                                            <td>{{$cities[2]}}</td>
                                                            <td>{{$cities[3]}}</td>
                                                            <td>{{$cities[4]}}</td>
                                                            <td>{{number_format((float)$cities[5], 2, '.', '') }}</td>
                                                            <td>{{number_format((float)$cities[6], 2, '.', '') }}</td>
                                                            <td>{{number_format((float)$cities[7], 2, '.', '') }}</td>
                                                        </tr>

                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">

                                        </div>
                                    </div>
                                </div>
                                <!-- /.table-responsive -->
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>

                </div>
            </div>
        </section>
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
            $('#dateRange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                }
            })

        });

    </script>


@endsection