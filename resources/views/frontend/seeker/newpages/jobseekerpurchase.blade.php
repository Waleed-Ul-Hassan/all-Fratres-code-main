@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','homepage')->first();@endphp

    @if ($seo)
        <meta name="description" content="{{$seo->meta_description}}">
        <meta name="keywords" content="{{$seo->meta_key}}">
        <meta name="title" content="{{$seo->meta_title}}">

    @endif


@endsection
@section('content')

    <div class="jobseekar-secure-main">
        <div class="container">
            <h1>Fratres secure payment page</h1>

            <form>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">
                        Select language</label>
                    <div class="col-sm-5">
                        <select class="form-control" id="paymentlanguage">
                            <option value="da">Dansk
                            </option>
                            <option value="de">Deutsch
                            </option><option value="et">Eesti
                            </option><option value="en" selected="selected">English
                            </option><option value="es">Español
                            </option><option value="el">Eλληνικά
                            </option><option value="fr">Français
                            </option><option value="it">Italiano
                            </option><option value="lv">Latviešu
                            </option><option value="hu">Magyar
                            </option><option value="nl">Nederlands
                            </option><option value="no">Norsk
                            </option><option value="pl">Polski
                            </option><option value="pt">Português
                            </option><option value="ro">Română
                            </option><option value="sk">Slovenčina
                            </option><option value="fi">Suomi
                            </option><option value="sv">Svenska
                            </option><option value="tr">Türkçe
                            </option><option value="cs">Čeština
                            </option><option value="bg">Български
                            </option><option value="ru">Ру́сский
                            </option><option value="ja">日本語
                            </option><option value="ko">한국어
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">
                        Choose currency
                    </label>
                    <div class="col-sm-5">
                        <select class="form-control" id="paymentcuurency">
                            <option value="GBP" selected="selected">£9.99 (Pounds Sterling)
                            </option><option value="EUR">EUR11.87 (Euro)
                            </option><option value="USD">US$12.85 (US Dollar)
                            </option>
                        </select>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">
                        CV-library Ltd
                        Description  	Enhanced Candidate Profile
                        Amount
                    </label>
                    <div class="col-sm-8">
                        <p>
                            Enhanced Candidate Profile

                        </p>
                        <p> £9.99</p>

                    </div>
                </div>


            </form>
            <div class="jobseeker-paymentmethod">
                <h2>Select your payment method</h2>
            </div>
            <div class="jobseeke-payment-method-list">
                <ul>
                    <li>
                        <a href="#" title="Master card">
                            <img src="{{url('frontend/assets/img/mastercard.gif')}}">
                        </a>
                        <span>master card</span>
                    </li>
                    <li>
                        <a href="#" title="Visa">
                            <img src="{{url('frontend/assets/img/visa.gif')}}">
                        </a>
                        <span>visa</span>
                    </li>
                    <li>
                        <a href="#" title="Maestro">
                            <img src="{{url('frontend/assets/img/mestro.gif')}}">
                        </a>
                        <span>Maestro</span>
                    </li>
                    <li>
                        <a href="#" title="Jcb">
                            <img src="{{url('frontend/assets/img/jcb.gif')}}">
                        </a>
                        <span>jcb</span>
                    </li>
                    <li>
                        <a href="#" title="MasterPass">
                            <img src="{{url('frontend/assets/img/masterpass.gif')}}">
                        </a>
                        <span>MasterPass
          </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection