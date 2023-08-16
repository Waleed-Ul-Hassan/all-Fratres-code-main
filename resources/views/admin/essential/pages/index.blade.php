@extends('admin.layout.main')

@section('content')
    <script src="{{asset('/js/cities.js')}}"></script>
    <div class="content-wrapper">
        <br>

        <!-- Main content -->
{{--        <div class="col-md-1">--}}
{{--            <a href="{{url('admin/add-pages')}}" class="btn btn-block btn-info">Add</a>--}}
{{--        </div>--}}
        <br>
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Privacy</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Privacy</th>
                                    <th>Terms</th>
                                    <th>About</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pages as $pagess)
                                    <tr>
                                        <td>{{$pagess->id}}</td>
                                        <td>{!! Str::limit(strip_tags($pagess->privacy),40, '....') !!}</td>
                                        <td>{!! Str::limit(strip_tags($pagess->terms),40, '....') !!}</td>
                                        <td>{!! Str::limit(strip_tags($pagess->about),40, '....') !!}</td>

                                        <td>
                                            <a href="{{url('admin/edit-pages',($pagess->id))}}"
                                               class="btn btn-info"> Edit</a>
                                        </td>
                                    </tr>
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