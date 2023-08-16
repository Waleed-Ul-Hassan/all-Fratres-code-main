@extends('admin.layout.main')

@section('content')
    <script src="{{asset('/js/jobs.js')}}"></script>
    <div class="content-wrapper">
        <br>


        <br>
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Jobs</h3>
                           @include('admin.jobs.buttons')
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="" class="table table-bordered table-striped table-sm table-hover" style="font-size: 15px;" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>City</th>
                                    <th>Salary</th>
                                    <th>Job Industry</th>
                                    {{--<th>Contract Type</th>--}}
                                    <th>Views</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $counter = 1; @endphp
                                @foreach($jobs as $jobss)
                                    <tr>
                                        <td>{{$counter}}</td>
                                        @if($jobss->recruiter != '')
                                        <td><a href="{{url('admin/detail-recruiter',($jobss->recruiter->id))}}"> {{$jobss->recruiter->company_name}}</a> </td>
                                        @else
                                            <td>N/A</td>
                                        @endif
                                        <td>{{$jobss->title}} <small class="float-right">({{$jobss->contract_type}})</small></td>
                                        @if( $jobss->get_city != '' )
                                            <td>{{$jobss->get_city->name}} @if($jobss->ip_origin != '')<small class="float-right">({!! displayVisitor($jobss->ip_origin) !!})</small>@endif</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{$settings->symbol}}{{$jobss->salary_min}} - {{$jobss->salary_max}}/{{$jobss->salary_schedule}}</td>
                                        @if($jobss->get_industry != '')
                                            <td>{{$jobss->get_industry->name}}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        {{--<td>{{$jobss->contract_type}}</td>--}}
                                        <td>{{$jobss->views}}</td>
                                        <td>
                                            <small>{{$jobss->created_at->format("d M Y")}}</small>
                                            <span class="badge badge-@if($jobss->job_status == 'active'){{'success'}}
                                                    @elseif($jobss->job_status == 'pause'){{'warning'}}
                                                    @elseif($jobss->job_status == 'draft'){{'secondary'}}
                                                    @elseif($jobss->job_status == 'paused'){{'danger'}}
                                            @endif ">
                                                {{$jobss->job_status}}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{url('admin/detail-jobs',($jobss->id))}}"
                                               class="btn btn-xs btn-info"> <i class="fa fa-eye"></i></a>
                                            @if($jobss->job_status== 'pending' ||$jobss->job_status== 'paused' ||$jobss->job_status== 'draft' || $jobss->job_status== 'expired')
                                                <a class="btn btn-xs btn-primary block" data-block="{{$jobss->id}}"><i
                                                            class="fa fa-check" aria-hidden="true"></i> Active</a>

{{--                                            @elseif ($jobss->job_status== 'active')--}}
{{--                                                <a class="btn btn-xs btn-secondary block" data-block="{{$jobss->id}}"><i--}}
{{--                                                            class="fa fa-pause" aria-hidden="true"></i> Pause</a>--}}
{{--                                            @elseif ($jobss->job_status== 'pause')--}}

{{--                                                <a class="btn btn-xs btn-primary block" data-block="{{$jobss->id}}"><i--}}
{{--                                                            class="fa fa-check" aria-hidden="true"></i> Active</a>--}}

                                            @endif
                                                <a class="btn btn-xs btn-danger reject" data-toggle="modal" data-target="#exampleModal" data-reject="{{$jobss->id}}"><i
                                                            class="fa fa-check" aria-hidden="true"></i> Pause</a>



                                        </td>
                                    </tr>
                                    @php $counter++; @endphp
                                @endforeach
                                </tbody>
                            </table>

                            <div class="clearfix mt-4">{{$jobs->links()}}</div>
                        </div>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reason to Pause Job</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">


                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Message:</label>
                                                <textarea class="form-control" name="job_reject_reason" id="job_reject_reason"></textarea>
                                            </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary abc rejects">Send message</button>
                                    </div>
                                </div>
                            </div>
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
                "paging": false,
            });
            $('#example2').DataTable({
                "paging": false,
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