
    @php
    $html = file_get_contents(json_decode($orders->stripe_response)->receipt_url);
    $html = str_replace("erfan@fratres.net", "info@fratres.net", $html);
    @endphp

    {!! $html !!}
