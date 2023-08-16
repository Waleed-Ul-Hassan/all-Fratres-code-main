@extends('admin.layout.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add Advertisement</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Advertisement</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Advertisement</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form method="post" action="{{url('admin/add-advertisement')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" class="form-control" name="title"
                                               placeholder="e.g Title" id="title">
                                    </div>



                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Placement Key</label>
                                    <input type="text" class="form-control" name="placement_key"
                                           placeholder="e.g Placement Key" id="placement_key">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Url</label>
                                    <input type="text" class="form-control" name="url"
                                           placeholder="e.g Url" id="url">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Image</label>
                                    <input type="file" class="form-control" name="advertisement"
                                           placeholder="e.g Image" id="advertisement">
                                </div>

                            </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>

                            </form>

                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>





@endsection