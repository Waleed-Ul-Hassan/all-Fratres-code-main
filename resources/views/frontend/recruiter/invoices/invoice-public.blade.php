@if( $orders->stripe_response != '' )
    <?php
// json_decode($orders->stripe_response)->receipt_url;
$data = file_get_contents(json_decode($orders->stripe_response)->receipt_url);
$data = str_replace("erfan@fratres.net", "info@fratres.net", $data);
    echo $data;
    ?>
@endif