@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','contact')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')

    <style>

    </style>

    <div class="recruiter-main-dashboard">
        <div class="recru-dash-head">
            <div class="recru-dash-headv1">
                <p>bottom</p>
            </div>

            @include('frontend.recruiter.partials.sidebar')

            <div class="recru-dash-item2">

                <div class="recru-post-jobhead">
                    <div class="recru-dash-item2-v1-title">
                        <h3>Contact</h3>
                    </div>
                </div>
                <div class="recru-dash-item2-v1-list">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item ">
                            <a class="nav-link active recruiter-tab" id="pills-personal-details-tab" data-toggle="pill" href="#pills-personal-details" role="tab" aria-controls="pills-active" aria-selected="true">View Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  recruiter-tab" id="pills-company-details-tab" data-toggle="pill" href="#pills-company-details" role="tab" aria-controls="pills-suspended" aria-selected="false">Contact Us</a>
                        </li>



                    </ul>
                </div>
                <div class="recur-item2-maincontent">

                    {{--tabs here--}}
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active col-md-12" id="pills-personal-details" role="tabpanel" aria-labelledby="pills-personal-details-tab">

                            <table class="table table-striped table-valign-middle ">
                                <thead>
                                <tr>
                                    <th class="width-20">Subject</th>
                                    <th class="width-70">Message</th>
                                    <th>Date</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{$contact->subject}}</td>
                                        <td class="width-70">{{$contact->message}}</td>
                                        <td>{{$contact->created_at->diffForHumans()}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>


                        </table>


                        </div>


                        <div class="tab-pane fade" id="pills-company-details" role="tabpanel" aria-labelledby="pills-company-details-tab">

                            <form action="{{url('recruiter/contact')}}" method="post">
                                @csrf
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label for="Subject" class="col-sm-3">
                                                    Subject</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="subject" class="form-control wizard-required"  id="Subject" value="" placeholder="" required>
                                                </div>
                                                <div class="wizard-form-error"></div>
                                            </div>




                                            <div class="form-group row">
                                                <label for="mesg" class="col-sm-3">
                                                    Your Message</label>
                                                <div class="col-sm-9">
                                                    <textarea name="message" class="form-control" id="mesg" cols="30" rows="5" required></textarea>

                                                    <p>	<small>* Please do not include credit card information in your message.</small></p>
                                                </div>
                                            </div>



                                            <div class="form-group clearfix">

                                                <div class="offset-md-3 col-sm-9 pl-6">
                                                    <button type="submit" class="btn btn-primary">Send</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            @foreach ($errors->all() as $message)
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{$message}}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>


                    </div>


                </div>


            </div>
        </div>
    </div>


@endsection