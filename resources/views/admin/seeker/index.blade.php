@extends('admin.layout.main')

@section('content')
    <script src="{{asset('/js/seeker.js')}}"></script>
    <div class="content-wrapper">
        <br>


        <br>
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Seekers</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="" class="table table-bordered table-striped table-sm table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>City</th>
                                    <th>Country</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($seeker as $seekers)
                                    <tr>
                                        @if($seekers->email_verified_at != null)
                                            <td title="Email Verified"><i class="fas fa-check fa-verified"></i></td>
                                        @else
                                            <td title="Email Not Verified"><i class="fas fa-times fa-unverified"></i></td>
                                        @endif
                                        <td>{{$seekers->first_name}}   <p><small class="float-right">({!! displayVisitor($seekers->ip_origin) !!})</small></p></td>
                                        <td>{{$seekers->email}}</td>
                                        <td>{{show_phone($seekers->phone,'phone')}}</td>
                                        <td>{{$seekers->gender ?? ''}}</td>
                                        <td>{{$seekers->city ?? ''}}</td>
                                        <td>{{$seekers->country ?? ''}}</td>
                                        <td>
                                            {{$seekers->created_at->format("d F Y")}}
                                        </td>
                                        <td>

                                            <a href="{{url('admin/detail-seekers',($seekers->id))}}"
                                               class="btn btn-xs btn-info"> Detail
                                            </a>

                    @if($seekers->email_verified_at==null)
                            <a class="btn btn-xs btn-primary block"  data-block="{{$seekers->id}}"><i
                                class="fa fa-check" aria-hidden="true"></i> Activate</a>
                        @else
                        <a class="btn btn-xs btn-danger block" data-block="{{$seekers->id}}"><i
                            class="fa fa-trash" aria-hidden="true"></i> Deactivate</a>
                    @endif

                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                            <br>
                            {{$seeker->links()}}
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
                "bPaginate": false
            });

        });
    </script>



@endsection