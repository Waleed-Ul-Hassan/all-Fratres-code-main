@extends('admin.layout.main')

@section('content')
    <script src="{{asset('/js/advertisement.js')}}"></script>
    <div class="content-wrapper">
        <br>

        <!-- Main content -->
        <div class="col-md-1">
            <a href="{{url('admin/add-advertisement')}}" class="btn btn-block btn-info">Add</a>
        </div>
        <br>
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Advertisement</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Placement Key</th>
                                    <th>Url</th>
                                    <th>Impressions</th>
                                    <th>Clicks</th>
                                    <th>CTR</th>
                                    <th>image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $counter = 1; @endphp
                                @foreach($advertisement as $advertisements)
                                    <tr>
                                        <td>{{$counter}}</td>
                                        <td>{{$advertisements->title}}</td>
                                        <td>{{$advertisements->placement_key}}</td>
                                        <td>{{$advertisements->url}}</td>
                                        <td>{{$advertisements->impressions}}</td>
                                        <td>{{$advertisements->clicks}}</td>
                                        <td>{{$advertisements->ctr}}</td>
                                        <td><img src="{{asset('advertisement/'.$advertisements->image)}}" width="100" height="100" /></td>
                                        <td>
                                            <a href="{{url('admin/edit-advertisement',($advertisements->id))}}"
                                               class="btn btn-xs btn-info"> Edit</a>
                                            <a class="btn btn-xs btn-danger delete" data-delete="{{$advertisements->id}}"><i
                                                        class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                            <a href="#"
                                               class="btn btn-xs btn-primary active" data-active="{{$advertisements->id}}"> Active</a>
                                            <a href="#"
                                               class="btn btn-xs btn-danger pause" data-pause="{{$advertisements->id}}" > Pause</a>

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