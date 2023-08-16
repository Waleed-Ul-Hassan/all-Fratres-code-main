@extends('admin.layout.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <!-- Widget: user widget style 2 -->
                        <div class="card card-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-warning">
                                <div class="widget-user-image">
                                    <img class="img-circle elevation-2"
                                         src="{{asset('/seekers/profile/'.$seekers->avatar)}}" alt="User Avatar">
                                </div>
                                <!-- /.widget-user-image -->
                                <h3 class="widget-user-username">{{$seekers->first_name}}</h3>
                                <h5 class="widget-user-desc">{{$seekers->current_job_title}}</h5>
                            </div>

                        </div>
                    </div>
                    <!-- /.widget-user -->
                    <div class="col-sm-6" style="font-size: 10px;">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Experience</h3>
                            </div>


                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-hover table-md">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Company</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>City</th>
                                        <th>Country</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $counter = 1; @endphp
                                    @foreach ($seekers->experience as $experience)
                                        <tr>
                                            <td>{{$counter}}</td>
                                            <td>{{$experience->job_title}}
                                                <div class="clearfix"></div>
                                                <a class="btn btn-danger btn-xs"
                                                   data-toggle="collapse"
                                                   href="#collapseExample{{$experience->id}}" role="button"
                                                   aria-expanded="false" aria-controls="collapseExample{{$experience->id}}">
                                                    Description
                                                </a>
                                                <div class="collapse" id="collapseExample{{$experience->id}}" style="position: absolute;z-index:999;border:2px solid #000;">
                                                    <div class="card card-body">
                                                        {!! $experience->description !!}
                                                    </div>
                                                </div>

                                            </td>
                                            <td>{{$experience->company}}</td>
                                            <td>{{date('M Y', strtotime($experience->date_start))}}</td>
                                            <td>{{date('M Y', strtotime($experience->date_start))}}</td>
                                            <td>{{$experience->job_city}}</td>
                                            <td>{{$experience->job_country}}</td>

                                        </tr>

                                        @php $counter++; @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                    <div class="col-sm-6" style="font-size: 10px;">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Projects</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-striped table-hover table-md">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Company</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $counter = 1; @endphp
                                    @foreach ($seekers->projects as $projects)
                                        <tr>
                                            <td>{{$counter}}</td>
                                            <td>{{$projects->project_title}}</td>
                                            <td>{{$projects->company}}</td>
                                            <td>{{date('M Y', strtotime($projects->date_start))}}</td>
                                            <td>{{date('M Y', strtotime($projects->date_start))}}</td>


                                        </tr>
                                        @php $counter++; @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                </div>


                <div class="col-md-12">
                    <!-- Widget: user widget style 2 -->
                    <div class="card card-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-warning">

                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Social</h3>
                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Facebook <span
                                                class="float-right badge bg-primary">{{$seekers->facebook_profile}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Twitter <span
                                                class="float-right badge bg-info">{{$seekers->twitter_profile}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Linkdin <span
                                                class="float-right badge bg-danger">{{$seekers->linkdin_profile ?? 'Not Available'}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Github <span
                                                class="float-right badge bg-success">{{$seekers->github_profile ?? 'Not Available'}}</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
                <!-- /.col -->


            </div>
            <!-- /.row -->
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "pageLength": 6,
            });
            $('#example2').DataTable({
                "pageLength": 6,
                "autoWidth": false,
                "responsive": true,

            });
        });
    </script>

@endsection