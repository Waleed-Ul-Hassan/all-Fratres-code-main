@extends('admin.layout.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add Package</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Package</li>
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
                                <h3 class="card-title">Add Package</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form method="post" action="{{url('admin/add-packages')}}" >
                                @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Package Name</label>
                                    <input type="text" class="form-control" name="name"
                                           placeholder="e.g Name" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="jobs">Package Jobs</label>
                                    <input type="text" class="form-control" name="jobs"
                                           placeholder="e.g 3" id="jobs">
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" name="price"
                                           placeholder="e.g Price" id="price">
                                </div>

                                <div class="form-group">
                                    <label for="features">Feature</label>
                                    <select name="features[]" id="features"
                                            class="form-control js-example-basic-multiple-limit" multiple="multiple">
                                        @foreach($features as $featuress)
                                        <option value="{{$featuress->name}}">{{$featuress->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>


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

    <script>
        $(".js-example-basic-multiple-limit").select2({

        });
    </script>



@endsection