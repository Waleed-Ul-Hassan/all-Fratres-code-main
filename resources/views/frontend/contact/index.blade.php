@extends('frontend.layouts.main')

@section('meta_info')
    <title>Fratres Contact</title>
    <meta name="description" content="Fratres Contact">
    <meta property="og:description" content="Fratres Contact">
    <meta name="keywords" content="Fratres Contact">
    <meta property="og:keywords" content="Fratres Contact">
    <meta name="title" content="Fratres Contact">
    <meta property="og:title" content="Fratres Contact">
    <meta property="og:type" content="jobs"/>
@endsection

@section('content')


    {!! NoCaptcha::renderJs() !!}
    <div class="container">
        <div class="row mt-5 mb-5">

        <div class="col touch-bg">

            <h4 class="mb-2 mt-2">Get in touch</h4>
            <p class="mb-3">If your question is not answered in the Fratres Help Centre, please contact us via the contact form.</p>

            <h5 class="mb-3 mt-5"><b>Postal address</b></h5>
            <p>Please note that we are not a recruitment agency and do not accept CVs by post. </p>

        </div>
        <div class="col">

            <form method="post" action="{{url('/contact_request')}}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Please select your status</option>
                        <option value="Job Seeker">Job Seeker</option>
                        <option value="Employer / Agency">Employer / Agency</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" class="form-control" id="message" required></textarea>
                </div>
                <div class="form-group">
                    {!! app('captcha')->display() !!}
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block"><strong style="color:red;">{{ $errors->first('g-recaptcha-response') }}</strong></span>
                    @endif
                </div>



                <button type="submit" class="btn btn-primary">Send enquiry</button>
            </form>

        </div>



        </div>
    </div>

@endsection