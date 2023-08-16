@extends('admin.layout.main')

@section('content')
    <script src="{{asset('/js/adminuser.js')}}"></script>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="col-md-1">
            <a href="{{url('admin/users')}}" class="btn btn-block btn-info">View</a>
        </div>
        <br>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Add Users</h3>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" id="name"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" id="email"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="password" class="form-control" id="password"/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control select2" style="width: 100%;" name="type" id="type">
                                        <option selected="selected">Select Type</option>
                                        <option value="Seo">Seo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" onclick="save()" class="btn btn-block btn-info">Add</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
{{--                        Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about--}}
{{--                        the plugin.--}}
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

        })
    </script>


@endsection