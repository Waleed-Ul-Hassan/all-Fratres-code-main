@extends('admin.layout.main')

@section('content')
    <script src="{{asset('/js/adminuser.js')}}"></script>
    <div class="content-wrapper">
        <br>

        <!-- Main content -->
        <div class="col-md-1">
            <a href="{{url('admin/add-users')}}" class="btn btn-block btn-info">Add</a>
        </div>
        <br>
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Admin Users</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->type}}</td>
                                        <td>@if($user->is_block==0) <span class="badge badge-success">active</span> @else <span class="badge badge-danger">blocked</span> @endif</td>
                                        <td>
                                            <a href="{{url('admin/edit-users',($user->id))}}"
                                               class="btn btn-info"> Edit</a>
                                            @if($user->is_block==0)
                                                <a class="btn btn-danger block" data-block="{{$user->id}}"><i
                                                            class="fa fa-trash" aria-hidden="true"></i> Block</a>
                                            @else

                                                <a class="btn btn-primary block" data-block="{{$user->id}}"><i
                                                            class="fa fa-check" aria-hidden="true"></i> Active</a>

                                            @endif

                                            <a class="btn btn-danger delete" data-delete="{{$user->id}}"><i
                                                        class="fa fa-trash" aria-hidden="true"></i> Delete</a>

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