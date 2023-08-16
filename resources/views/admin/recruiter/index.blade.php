@extends('admin.layout.main')

@section('content')
    <style>
        p{
            margin-bottom: 0rem;
        }
    </style>
    <script src="{{asset('/js/recruiters.js')}}"></script>
    <div class="content-wrapper">
        <br>


        <br>
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recruiters</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="" class="table table-bordered table-striped table-sm table-hover">
                                <thead>
                                <tr>
<th></th>
                                    <th>Company Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>

                                    <th>Jobs Posted</th>

                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($recruiter as $recruiters)
                                    <tr>
                                        @if($recruiters->email_verified_at != null)
                                            <td title="Email Verified"><i class="fas fa-check fa-verified"></i></td>
                                        @else
                                            <td title="Email Not Verified"><i class="fas fa-times fa-unverified"></i></td>
                                        @endif
                                        <td>
                                <a href="{{$recruiters->company_url}}"> {{$recruiters->company_name}}</a>
                                <p>{{$recruiters->company_size ?? 'Not Available'}} - Employees</p>
                                            <p><small class="float-right">({!! displayVisitor($recruiters->ip_origin) !!})</small></p>
                                        </td>
                                        <td>{{$recruiters->email}}</td>
                                        <td>
                                            <p>{{$recruiters->phone}}</p>
                                            <p>Country : {{$recruiters->country}}</p>
                                            <p>City : {{$recruiters->cities->name ?? 'Not Available'}}</p>
                                        </td>

                                        <td>{{count($recruiters->jobs) ?? 'Not Available'}}</td>

                                        <td>
                                            {{$recruiters->created_at->format("d F Y")}}

                                        </td>
                                        <td>
                                            <a href="{{url('admin/detail-recruiter',($recruiters->id))}}"
                                               class="btn btn-xs btn-info"> Detail</a>
                                            @if($recruiters->email_verified_at== null)
                                                <a class="btn btn-xs btn-primary block"
                                                   data-block="{{$recruiters->id}}"><i
                                                            class="fa fa-check" aria-hidden="true"></i> Active</a>

                                            @else

                                                <a class="btn btn-xs btn-danger block" data-block="{{$recruiters->id}}"><i class="fa fa-trash" aria-hidden="true"></i> Block</a>

                                            @endif

                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                            <br>
                            {{$recruiter->links()}}
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
                "pageLength": 55,
                "bPaginate": false
            });

        });
    </script>



@endsection