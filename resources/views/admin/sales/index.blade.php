@extends('admin.layout.main')

@section('content')
    <script src="{{asset('/js/seo.js')}}"></script>
    <div class="content-wrapper">
        <br>

        <!-- Main content -->
        <div class="row " style="margin-left: 5px;">
            <div class="col-md-2">
                <a href="{{url('admin/sales/add')}}" class="btn  btn-info">Send Emails</a>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn  btn-info" data-toggle="modal" data-target="#exampleModal">Import Emails</button>

            </div>
        </div>


        <section class="content">

            @if($errors->any())
                <div class="alert alert-danger" style="margin-top: 20px;">
                    {{$errors->first()}}
                </div>
            @endif
            @if(session('success'))
                    <div class="alert alert-success" style="margin-top: 20px;">
                        {{session('success')[0]}}
                    </div>
            @endif

            <br>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">SALES REPORT</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>

                                    <th>File</th>
                                    <th>Emails</th>
                                    <th>Last Sent</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sales as $sale)
                                    <tr>

                                        <td>{{$sale->filename}}</td>
                                        <td>{{$sale->emails}}</td>
                                        <td>{{$sale->last_sent}}</td>
                                        <td>
                                            <a href="{{url('admin/sales/delete/'.$sale->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Emails</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{url('admin/sales/upload_emails')}}" id="formUpload" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">File Name</label>
                                <input type="text" name="filename" class="form-control" placeholder="Enter Filename">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"></label>
                                <input type="file" id="EmailsUpload" name="file"  value="Upload File" />
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

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

        $("#EmailsUpload").on("change", function () {
            // $("#formUpload").submit();
        })
    </script>


@endsection