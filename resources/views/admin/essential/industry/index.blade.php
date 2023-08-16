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
                            <h3 class="card-title">Industry</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover" style="font-size: 15px;" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Total Jobs</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $counter = 1; @endphp
                                @foreach($industry as $industrys)
                                    <tr>
                                        <td>{{$counter}}</td>
                                        <td>{{$industrys->total_jobs}}</td>
                                        <td>{{$industrys->name}}</td>
                                        <td>{{$industrys->created_at->diffForHumans()}}</td>


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