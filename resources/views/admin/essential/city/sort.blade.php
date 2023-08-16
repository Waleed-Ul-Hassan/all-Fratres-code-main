@extends('admin.layout.main')

@section('content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <style>
        #sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
        #sortable li { margin: 0 3px 3px 3px; padding: 0.5em 0.4em 0.2em; padding-left: 1.5em; font-size: 1em;
            height: 38px; width: 30%; display: inline-block; margin-left: 2%;margin-bottom: 2%; }
        #sortable li span { position: absolute; margin-left: -1.3em; }
        .ui-icon-arrowthick-2-n-s {
            background-position: -127px -47px;
        }
        .ui-icon {
            margin-top: 0em;
        }
    </style>
    <div class="content-wrapper">
        <br>

        <!-- Main content -->
        <form action="" method="get" class="width-100">
        <div class="row p-2">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Search" name="q" value="{{request('q')}}">
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
        </div>
        </form>
        <br>
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">City</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <ul id="sortable">
                                @foreach($cities as $citiess)
                                    <li class="ui-state-default" data-id="{{$citiess->id}}" data-index="{{$loop->index+1}}"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>{{$citiess->name}}
                                    <input type="number" class="float-right ib" value="{{$loop->index+1}}"> <small class="text-red float-right mr-3"> ({{$citiess->total_jobs}} jobs)</small></li>
                                @endforeach
                            </ul>

                            <!-- Data Loader -->
                            <div class="auto-load text-center">
                                <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                <path fill="#000"
                      d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                      from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                </path>
            </svg>
                            </div>
                        </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <script>

        var page = 1;
        var ENDPOINT = '{{url("/")}}';
        infinteLoadMore(page);

        function alllists() {
            var cc = 1;
            var data = [];
            $("ul#sortable li").each(function (index) {
                $(this).attr("data-index", cc);
                $(this).find(".ib").val(cc);
                data.push({ id: $(this).attr("data-id"), index : $(this).attr("data-index")});
                cc++;
            });

            return data;
        }

        $( function() {
            $( "#sortable" ).sortable({
                forcePlaceholderSize: true,
                stop: function( event, ui ) {
                    // var index = $(ui.item).data('index');
                    // console.log("changed", index);
                    // alllists();
                    saveAll(page, alllists());
                }
            });
        } );

        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                infinteLoadMore(page);
            }
        });

        function infinteLoadMore(page) {
            $.ajax({
                url: ENDPOINT + "/admin/cities/sort?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').show();
                }
            })
                .done(function (response) {
                    if (response.length == 0) {
                        $('.auto-load').html("We don't have more data to display :(");
                        return;
                    }
                    $('.auto-load').hide();
                    $("#sortable").append(response);
                    alllists();
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }

        function saveAll(page, data) {
            console.log('asd');
            $.ajax({
                url: ENDPOINT + "/admin/cities/sort_save",
                data: { page: page, data: data},
                headers :{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // datatype: "html",
                type: "post",
            })
                .done(function (response) {
                    if (response.length == 0) {
                        $('.auto-load').html("We don't have more data to display :(");
                        return;
                    }
                    $('.auto-load').hide();
                    $("#sortable").append(response);
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }






    </script>



@endsection