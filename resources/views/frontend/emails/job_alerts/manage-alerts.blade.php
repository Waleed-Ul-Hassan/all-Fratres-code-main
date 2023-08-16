@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','job_listing')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <style>
        body{
            background: #f9f9f9;
        }

        .email-span{
            color:#ff8a00;
            font-size: 15px;
        }
        .email-heading{
            color:#ff8a00;
        }
        .fa-trash{
            opacity: .7;
            margin-top: 10px;
            font-size: 14px;
            color:red;
        }
        .fa-trash:hover{
            opacity: 1;
            cursor: pointer;
        }
        .table td, .table th {
            padding: 1.45rem;

        }

        .onoffswitch {
            position: relative; width: 87px;
            -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
        }
        .onoffswitch-checkbox {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }
        .onoffswitch-label {
            display: block; overflow: hidden; cursor: pointer;
            height: 36px; padding: 0; line-height: 36px;
            border: 2px solid #E3E3E3; border-radius: 36px;
            background-color: #120404;
            transition: background-color 0.3s ease-in;
        }
        .onoffswitch-label:before {
            content: "";
            display: block; width: 36px; margin: 0px;
            background: #FFFFFF;
            position: absolute; top: 0; bottom: 0;
            right: 49px;
            border: 2px solid #E3E3E3; border-radius: 36px;
            transition: all 0.3s ease-in 0s;
        }
        .onoffswitch-checkbox:checked + .onoffswitch-label {
            background-color: #49E845;
        }
        .onoffswitch-checkbox:checked + .onoffswitch-label, .onoffswitch-checkbox:checked + .onoffswitch-label:before {
            border-color: #49E845;
        }
        .onoffswitch-checkbox:checked + .onoffswitch-label:before {
            right: 0px;
        }

    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <br>
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h4 class="">Email Preferences for <span class="email-span">{{$emails}}</span></h4>
                        <p class="">Get exactly the job alerts you want by adjusting your search terms and frequency.</p>
                    </div>
                </div>

            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-10">
                <br>
                <table class="table bg-white td-updated ">
                    <tbody>
                    <tr>
                        <td><h5><b>Job alert emails</b></h5></td>
                        <td></td>
                    </tr>
                    @foreach($job_alerts as $job_alert)
                        <tr>
                            <td><b><u>{{$job_alert->job_title}}</u></b></td>
                            <td>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" value="{{$job_alert->id}}" id="myonoffswitch{{$job_alert->id}}" tabindex="0" @if($job_alert->sending_frequency == null) checked @endif>
                                            <label class="onoffswitch-label" for="myonoffswitch{{$job_alert->id}}"></label>
                                        </div>
                                        {{--<input type="checkbox" checked data-toggle="toggle" data-onstyle="primary">--}}

                                    </div>
                                    <div class="col">

                                        <i class="fas fa-trash fa-delete" data-record="{{$job_alert->random_id}}"></i>
                                        
                                    </div>
                                </div>
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        $(document).on("click", ".fa-delete", function () {

            var row = $(this).closest('tr');

            var id = $(this).attr("data-record");
            $.get("/email-preferences/ajax/unsubscribe/"+id, function(data, status){
                if( status == 'success' ){
                    row.remove();
                    toastr.success('Alert was Deleted Successfully')
                }
                // alert("Data: " + data + "\nStatus: " + status);
            });
        })

        $(document).on("click", ".onoffswitch-checkbox", function () {

            var value = $(this).val();

            $.get("/email-preferences/ajax/disable/"+value, function(data, status){
                if( status == 'success' ){
                    toastr.success(data)
                }
            });
        })



    </script>
@endsection


