@extends('admin.layout.main')

@section('content')
    <script src="{{asset('js/cities.js')}}"></script>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Update City</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Update City</li>
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
                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update City</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">City</label>
                                        <input type="text" value="{{$cities->name}}" class="form-control" name="name"
                                               placeholder="e.g Programming" id="name">
                                    </div>

                                </div>
                            <input type="hidden" value="{{$cities->id}}" id="id" name="id">
                                <!-- /.card-body -->

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Latitude</label>
                                    <input type="text" value="{{$cities->lat}}" class="form-control" name="lat"
                                           placeholder="e.g Latitude" id="lat">
                                </div>

                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Longitude</label>
                                    <input type="text" value="{{$cities->lon}}" class="form-control" name="lon"
                                           placeholder="e.g Longitude" id="lon">
                                </div>

                            </div>

                                <div class="card-footer">
                                    <button type="submit" onclick="update()" class="btn btn-primary">Update</button>
                                </div>

                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>





@endsection