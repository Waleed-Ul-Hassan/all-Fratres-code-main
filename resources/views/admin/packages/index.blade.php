@extends('admin.layout.main')

@section('content')

    <div class="content-wrapper">
        <br>

        <!-- Main content -->
        <div class="col-md-7">
            <a href="{{url('admin/add-packages')}}" class="btn  btn-info">Add Packages</a>
            <a href="{{url('admin/package-feature')}}" class="btn  btn-info">Packages Features</a>
        </div>
        <br>
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Packages</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Jobs</th>
                                    <th>Price</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $counter = 1; @endphp
                                @foreach($packages as $packagess)
                                    <tr>
                                        <td>{{$counter}}</td>
                                        <td>{{$packagess->name}}</td>
                                        <td>{{$packagess->jobs}}</td>
                                        <td>{{$packagess->price}}</td>
                                        <td>{{$packagess->features}}</td>
                                        <td>
                                            <a href="{{url('admin/edit-packages',($packagess->id))}}"
                                               class="btn btn-info"> Edit</a>
                                            <a href="{{url('admin/delete-packages',($packagess->id))}}" class="btn btn-danger delete"><i
                                                        class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                                        </td>
                                    </tr>
                                    @php $counter++; @endphp
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

    @if(session('message'))

        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'success',
                title: "{{ @session('message') }}"
            })

        </script>

    @endif

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