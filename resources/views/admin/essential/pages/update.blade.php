@extends('admin.layout.main')

@section('content')
    <script src="{{asset('js/privacy.js')}}"></script>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add Privacy</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Privacy</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <script>
            $(function () {
                // Summernote
                $('.textarea').summernote()
            })
        </script>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">

                            <!-- tools box -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse"
                                        data-toggle="tooltip"
                                        title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove"
                                        data-toggle="tooltip"
                                        title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body pad">
                            <label for="exampleInputEmail1">Privacy</label>
                            <div class="mb-3">
                <textarea class="textarea" name="privacy"
                          placeholder="e.g Privacy" id="privacy">{!!$pages->privacy!!}</textarea>
                            </div>

                        </div>

                        <input type="hidden" id="id" name="id" value="{{$pages->id}}">

                        <div class="card-body pad">
                            <label for="exampleInputEmail1">Terms</label>
                            <div class="mb-3">
                <textarea class="textarea" name="terms"
                          placeholder="e.g Terms" id="terms">{!!$pages->terms!!}</textarea>
                            </div>

                        </div>

                        <div class="card-body pad">
                            <label for="exampleInputEmail1">About</label>
                            <div class="mb-3">
                <textarea class="textarea" name="about"
                          placeholder="e.g About" id="about">{!!$pages->about!!}</textarea>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" onclick="update()" class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </div>

                <!-- /.col-->
            </div>
            <!-- ./row -->
        </section>
        <!-- Main content -->

        <!-- /.content -->
    </div>





@endsection