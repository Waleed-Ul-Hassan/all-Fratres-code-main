@extends('admin.layout.main')

@section('content')

    <div class="content-wrapper">
        <br>

        <!-- Main content -->
        <div class="col-md-1">
        </div>
        <br>
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Blogs</h3>
                            <a href="{{url('/admin/blogs/users')}}" class="float-right" >Add Users</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Blog Cat</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Blog Likes</th>
                                    <th>Blog Dislike</th>
                                    <th>Publish Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $counter = 1; @endphp
                                @foreach($blogsJsonDecode as $blog)
                                    @foreach($blog as $blogs)

                                        <tr>
                                            <td>{{$counter}}</td>
                                            <td>{{$blogs['blog_cat']}}</td>
                                            <td>{{$blogs['title']}}</td>
                                            <td>{{$blogs['status']}}</td>
                                            <td>{{$blogs['blog_like']}}</td>
                                            <td>{{$blogs['blog_dislike']}}</td>
                                            <td>{{$blogs['date']}}</td>
                                            <td>

                                                <a href="{{url('admin/blogs/'.$blogs['id'])}}" class="btn btn-success btn-sm "><i
                                                            class="fa fa-arrow-right" aria-hidden="true"></i> Details</a>

                                                <form action="{{url('http://blog.fratres.net/api/blogs-show/'.$blogs['id'])}}" method="post" >
                                                    <button type="submit" class="btn btn-sm btn-success active"><i
                                                                class="fa fa-check" aria-hidden="true"></i> Active</button>
                                                </form>

                                                <form action="{{url('http://blog.fratres.net/api/blogs-hide/'.$blogs['id'])}}" method="post" >
                                                    <button type="submit" class="btn btn-sm btn-primary inactive"><i
                                                                class="fa fa-close" aria-hidden="true"></i> InActive</button>
                                                </form>

                                                <form action="{{url('http://blog.fratres.net/api/blogs-delete/'.$blogs['id'])}}" method="post" >
                                                    <button type="submit" class="btn btn-sm btn-danger delete"><i
                                                                class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                                </form>

                                            </td>
                                        </tr>
                                        @php $counter++; @endphp
                                    @endforeach
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
{{--        $(document).on("click", ".delete", function () {--}}

{{--            var urls_delete = 'https://blog.fratres.net/api/blogs-delete/';--}}

{{--            var id = jQuery(this).attr('data-delete');--}}


{{--            const Toast = Swal.mixin({--}}
{{--                toast: true,--}}
{{--                position: 'top-end',--}}
{{--                showConfirmButton: false,--}}
{{--                timer: 1000--}}
{{--            });--}}


{{--            jQuery.ajax({--}}
{{--                type: "post",--}}
{{--                url: urls_delete + id,--}}
{{--                success: function (response) {--}}
{{--                    console.log(response.status)--}}
{{--                    console.log(response.status)--}}
{{--                    if (response.status == 1) {--}}

{{--                        Toast.fire({--}}
{{--                            icon: 'success',--}}
{{--                            title: 'Blogs is Deleted'--}}
{{--                        })--}}
{{--                        $(function () {--}}
{{--                            setTimeout(function () {--}}
{{--                                window.location.href = "/blogs";--}}

{{--                            }, 1000);--}}
{{--                        });--}}

{{--                    }--}}
{{--                },--}}
{{--                error: function (response) {--}}

{{--                    Toast.fire({--}}
{{--                        icon: 'warning',--}}
{{--                        title: 'Blogs is not Deleted yet'--}}
{{--                    })--}}
{{--                    return false;--}}

{{--                }--}}
{{--            });--}}


{{--        });--}}

{{--        $(document).on("click", ".active", function () {--}}

{{--            var urls_active = 'https://blog.fratres.net/api/blogs-show/';--}}

{{--            var id = jQuery(this).attr('data-active');--}}


{{--            const Toast = Swal.mixin({--}}
{{--                toast: true,--}}
{{--                position: 'top-end',--}}
{{--                showConfirmButton: false,--}}
{{--                timer: 1000--}}
{{--            });--}}


{{--            jQuery.ajax({--}}

{{--                type: "post",--}}
{{--                url: urls_active + id,--}}
{{--                headers: { 'Access-Control-Allow-Origin': '*' },--}}
{{--                success: function (response) {--}}
{{--                    console.log(response);--}}
{{--                    console.log(url);--}}

{{--                    if (response.status == 1) {--}}

{{--                        Toast.fire({--}}
{{--                            icon: 'success',--}}
{{--                            title: 'Blogs is Active'--}}
{{--                        })--}}
{{--                        $(function () {--}}
{{--                            setTimeout(function () {--}}
{{--                                window.location.href = "/blogs";--}}

{{--                            }, 1000);--}}
{{--                        });--}}

{{--                    }--}}
{{--                },--}}
{{--                error: function (response) {--}}

{{--                    Toast.fire({--}}
{{--                        icon: 'warning',--}}
{{--                        title: 'Blogs is not Active yet'--}}
{{--                    })--}}
{{--                    return false;--}}

{{--                }--}}
{{--            });--}}


{{--        });--}}

{{--        $(document).on("click", ".inactive", function () {--}}

{{--            var urls_hide = 'http://blog.fratres.net/api/blogs-hide/';--}}

{{--            var id = jQuery(this).attr('data-inactive');--}}


{{--            const Toast = Swal.mixin({--}}
{{--                toast: true,--}}
{{--                position: 'top-end',--}}
{{--                showConfirmButton: false,--}}
{{--                timer: 1000--}}
{{--            });--}}


{{--            jQuery.ajax({--}}
{{--                type: "post",--}}
{{--                url: urls_hide + id,--}}
{{--                success: function (response) {--}}
{{--                    console.log(response.status)--}}
{{--                    console.log(response.status)--}}
{{--                    if (response.status == 1) {--}}

{{--                        Toast.fire({--}}
{{--                            icon: 'success',--}}
{{--                            title: 'Blogs is inActive'--}}
{{--                        })--}}
{{--                        $(function () {--}}
{{--                            setTimeout(function () {--}}
{{--                                window.location.href = "/blogs";--}}

{{--                            }, 1000);--}}
{{--                        });--}}

{{--                    }--}}
{{--                },--}}
{{--                error: function (response) {--}}

{{--                    Toast.fire({--}}
{{--                        icon: 'warning',--}}
{{--                        title: 'Blogs is not inActive yet'--}}
{{--                    })--}}
{{--                    return false;--}}

{{--                }--}}
{{--            });--}}


{{--        });--}}
{{--    </script>--}}


@endsection