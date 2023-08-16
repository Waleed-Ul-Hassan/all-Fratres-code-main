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
                            <h3 class="card-title">Cvs</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Templates</th>
                                    <th>Number of Downloads</th>

                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $counter = 1;
                                    $extention = '.png';
                                @endphp
                                @foreach($trackcv as $trackcvs)
                                    @if($trackcvs->template_name == 'template-3')
                                        @php $extention = '.jpg'; @endphp
                                    @else
                                        @php $extention = '.png'; @endphp
                                    @endif
                                    <tr>
                                        <td>{{$counter}}</td>
                                        <td><img src="{{asset('seekers/cv-templates/'.$trackcvs->template_name.$extention)}}" width="80" alt="{{$trackcvs->template_name}}"></td>
                                        <td>{{$trackcv->sum('downloads')}}</td>

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