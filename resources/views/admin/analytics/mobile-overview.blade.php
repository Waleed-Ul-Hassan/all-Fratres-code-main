@extends('admin.layout.main')

@section('content')
    <style>
        #myChart {
            height: 400px; /* The height is 400 pixels */
            width: 100%; /* The width is the width of the web page */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script>
        $(function () {
            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',

                // The data for our dataset
                data: {
                    labels: {!! $mobileUsersDate !!},
                    datasets: [{
                        label: 'Users',
                        backgroundColor: 'rgb(255, 99, 132)',
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
                            <option value="15" @if(isset($_GET['days']) && $_GET['days'] == 15) selected @endif>Last 15
                                Days
                            </option>
                            <option value="30" @if(isset($_GET['days']) && $_GET['days'] == 30) selected @endif>Last 30
                                Days
                            </option>
                            <option value="45" @if(isset($_GET['days']) && $_GET['days'] == 45) selected @endif>Last 45
                                Days
                            </option>
                            <option value="60" @if(isset($_GET['days']) && $_GET['days'] == 60) selected @endif>Last 2
                                Months
                            </option>
                        </select>
                    </div>
                    <div class="col-md-12">


                        <!-- TABLE: LATEST ORDERS -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Users</h3>

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
                            <canvas id="myChart" style="height: 400px;width: 100%"></canvas>
                        </div>
                        <!-- /.card -->
                    </div>


                    <div class="col-md-12">


                        <!-- TABLE: LATEST ORDERS -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Device Category</h3>

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
                                                            aria-label="Date: activate to sort column descending">Device Category
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
                                                        <th class="text-right"> {{$devices->totalsForAllResults['ga:users']}}
                                                            <br>
                                                            <small>% of Total:<br> 100.00%
                                                                ({{$devices->totalsForAllResults['ga:users']}})</small>
                                                        </th>
                                                        <th>{{$devices->totalsForAllResults['ga:newUsers']}}
                                                            <br>
                                                            <small>% of Total:<br> 100.00%
                                                                ({{$devices->totalsForAllResults['ga:newUsers']}}
                                                                )</small>
                                                        </th>
                                                        <th>{{$devices->totalsForAllResults['ga:sessions']}}
                                                            <br>
                                                            <small>% of Total:<br> 100.00%
                                                                ({{$devices->totalsForAllResults['ga:sessions']}}
                                                                )</small>
                                                        </th>
                                                        <th> {{number_format((float)$devices->totalsForAllResults['ga:bounceRate'], 2, '.', '') }}
                                                            <br>
                                                            <small>% of Total:<br> 100.00%
                                                                ({{number_format((float)$devices->totalsForAllResults['ga:bounceRate'], 2, '.', '')}}
                                                                )</small>
                                                        </th>
                                                        <th>{{number_format((float)$devices->totalsForAllResults['ga:pageviewsPerSession'], 2, '.', '') }}
                                                            <br>
                                                            <small>% of Total:<br> 100.00%
                                                                ({{number_format((float)$devices->totalsForAllResults['ga:pageviewsPerSession'], 2, '.', '')}}
                                                                )</small>
                                                        </th>
                                                        <th>{{number_format((float)$devices->totalsForAllResults['ga:avgSessionDuration'], 2, '.', '') }}
                                                            <br>
                                                            <small>% of Total:<br> 100.00%
                                                                ({{number_format((float)$devices->totalsForAllResults['ga:avgSessionDuration'], 2, '.', '')}}
                                                                )</small>
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($devices as $devicess)

                                                        <tr role="row" class="text-center">
                                                            <td class="sorting_1" tabindex="0">{{$devicess[0]}}</td>
                                                            <td>{{$devicess[1]}}</td>
                                                            <td>{{$devicess[2]}}</td>
                                                            <td>{{$devicess[3]}}</td>
                                                            <td>{{number_format((float)$devicess[4], 2, '.', '') }}</td>
                                                            <td>{{number_format((float)$devicess[5], 2, '.', '') }}</td>
                                                            <td>{{number_format((float)$devicess[6], 2, '.', '') }}</td>
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
    $(function () {
        $('#dateRange').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            }
        })

    });

</script>




@endsection