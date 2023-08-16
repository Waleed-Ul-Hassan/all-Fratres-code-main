@extends('admin.layout.main')

@section('content')

    <div class="content-wrapper">
        <br>


        <br>
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Bugs</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover" style="font-size: 15px;" >
                                <thead>
                                <tr>
                                    <th style="width:50px;">#</th>
                                    <th style="max-width:220px;">Page</th>
                                    <th style="max-width:400px;">Message</th>
                                    <th>Bug Date</th>
                                </tr>
                                </thead>

                                <tbody>
                                @php $counter = 1; @endphp
                                @foreach($bugs as $bug)
                                    <tr>
                                        <td style="width:50px;">{{$counter}}</td>
                                        <td style="max-width:220px;">{{$bug->activity_on}}
                                            <div class="clearfix"><br></div>
                                            <a href="{{url('admin/bug-delete/'.$bug->id)}}" class="btn btn-danger btn-xs" >Delete</a>
                                        </td>
                                        <td style="max-width:400px;">{{$bug->message}}</td>
                                        <td>{{$bug->created_at->diffForHumans()}}</td>


                                    </tr>
                                    @php $counter++; @endphp
                                @endforeach
                                </tbody>
                            </table>

                            {{$bugs->links()}}
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

        });
    </script>



@endsection