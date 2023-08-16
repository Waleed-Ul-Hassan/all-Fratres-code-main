@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Sales</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Sales</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
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

            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <form method="post" id="SalesEmail" action="{{url('admin/sales/send/emails')}}">
                    <input type="hidden" class="is_preview" name="preview" value="0">

                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Choose Users</h3>
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Subject</label>
                                        <input type="text" class="form-control" name="subject" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Headline</label>
                                        <input type="text" class="form-control" name="headline" placeholder="Eid Special" required>
                                    </div>




                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Choose Coupon</label>
                                        <select name="coupon" class="form-control" required id="">
                                        @foreach($coupons as $coupon)
                                                <option value="{{$coupon->id}}">{{$coupon->coupon_code}} - ({{$coupon->discount}} %)</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1" style="display: block">File Name <a href="#" class="float-right mails_list" data-toggle="modal" data-target="#exampleModal">preview emails</a> </label>
                                        <select name="rid" class="form-control" required id="rid">
                                        @foreach($sales as $file)
                                                <option value="{{encrypt($file->id)}}">{{$file->filename}} - ({{$file->emails}} emails)</option>
                                            @endforeach
                                        </select>

                                    </div>



                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Send Mails</button>
                                    <button type="button" id="preview" class="btn btn-primary">Preview Template</button>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Template</h3>
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <img src="{{asset('sales/images/template-1.png')}}" width="200" alt="">
                                    </div>

                                </div>


                            </div>

                        </div>





                    <!-- ./col -->
                    </div>
                </form>
            </div>
        </section>
        <!-- /.content -->
    </div>


    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body email-list">
                    <i class="fas fa-spinner fa-spin fa-5x text-center"></i>
                </div>

            </div>
        </div>
    </div>

    <script>

        $(document).on("click", "#preview", function () {
             $(".is_preview").val(1);
             $("#SalesEmail").attr('target', '_blank');
             $("#SalesEmail").submit();
        });

        $(document).on("click", ".mails_list", function () {
            $(".email-list").html('<i class="fas fa-spinner fa-spin fa-5x text-center"></i>')

             var list_id = $("#rid :selected").val();
            var request;

            request = $.ajax({
                url: "/admin/sales/template-id",
                type: "get",
                data: {id : list_id}
            });

            // Callback handler that will be called on success
            request.done(function (response, textStatus, jqXHR){
                // Log a message to the console

                $(".email-list").html(response.data)
                $(".modal-title").html(response.file)
                // console.log( response );
            });


        });



        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
        </script>




@endsection