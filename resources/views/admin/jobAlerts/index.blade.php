@extends('admin.layout.main')

@section('content')
    <script src="{{asset('/js/jobs.js')}}"></script>
    <div class="content-wrapper">
        <br>


        <br>
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Job Alerts</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover" style="font-size: 15px;" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Job Title</th>
                                    <th>City</th>
                                    <th>Industry</th>
                                    <th>Skills</th>
                                    <th>created_at</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $counter = 1; @endphp
                                @foreach($jobAlerts as $jobss)
                                    <tr>
                                        <td>{{$counter}}</td>
                                        <td>{{$jobss->email}}</td>
                                        <td>{{$jobss->job_title}}</td>
                                        <td>{{$jobss->city->name ?? ''}}</td>
                                        <td>{{$jobss->industry->name ?? ''}}</td>
                                        <td>
                                            @foreach($jobss->skills as $skills)
                                                <span class="badge badge-success">{{$skills->name}}</span>
                                            @endforeach
                                        </td>

                                        <td>{{$jobss->created_at->diffForHumans()}}</td>
                                       

                                    </tr>
                                    @php $counter++; @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>



@endsection