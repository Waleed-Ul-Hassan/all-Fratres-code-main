@extends('admin.layout.main')

@section('content')

    <div class="content-wrapper">
        <br>

        <!-- Main content -->
        <div class="col-md-1">
        </div>
        <br>

        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Users</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="post" action="{{url('https://blog.fratres.net/api/create/user')}}" >
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name"
                                               placeholder="e.g Name" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="jobs">Email</label>
                                        <input type="text" class="form-control" name="email"
                                               placeholder="e.g 3" id="Email">
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Password</label>
                                        <input type="text" class="form-control" name="password"
                                               placeholder="e.g Price" id="Password">
                                    </div>


                                </div>


                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
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