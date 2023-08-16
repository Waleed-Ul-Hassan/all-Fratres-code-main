@extends('admin.layout.main')

@section('content')
    <script src="{{asset('/js/delete.js')}}"></script>
    <div class="content-wrapper">
        <br>


        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Emails</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>

                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($emails)
                                @php $counter = 1; @endphp
                                @foreach($emails as $email)
                                    <tr>
                                        <td>{{$counter}}</td>
                                        <td>{{$email->email}}</td>
                                        <td>{{$email->created_at->diffForHumans()}}</td>

                                        <td>

                                            <a class="btn btn-danger delete" data-path="/admin/newsletter/delete/{{$email->id}}" data-mesg="Email"><i
                                                        class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                                        </td>
                                    </tr>
                                    @php $counter++; @endphp
                                @endforeach
                                    @endif
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