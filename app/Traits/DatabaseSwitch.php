<?php

namespace App\Traits;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

trait DatabaseSwitch
{

    public function switch_db() {


        $domain = request()->getHttpHost();

        Config::set('app.url', 'https://' . $domain);

        $domain = str_replace(".fratres.net", "", $domain);

        $key = 'pk_test_fsxF2xHWfRC0MQMIQyqZVpUF';
        $secret = 'sk_test_27um5LQl0I9TyQz6OEgKaIrq';

//        $key = 'pk_live_HP4krDY1Bv3J2TJdYXMdpbYw';
//        $secret = 'sk_live_A9NUXwCCrJiOw2LyvG1FEKCd';

        $database_host = 'localhost';
      
        switch ($domain) {
           
            case 'staging':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_staging';
                $database_user = 'saqlain_ae';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'AED';
            break;
            case 'uk':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_fratres_uk';
                $database_user = 'saqlain_uk';
                $database_pass = 'bu78x8g7_fratres';

//                $database_name = 'saqlain_fratres_uk';
//                $database_user = 'saqlain_uk';
//                $database_pass = 'bu78x8g7_fratres';
                $currency = 'eur';
                break;
            case 'in':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_in_india';
                $database_user = 'saqlain_in';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'inr';
                break;

            case 'at':

//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_at_austria';
                $database_user = 'saqlain_at';
                $database_pass = 'bu78x8g7_fratres';

//                $database_name = 'saqlain_at_austria';
//                $database_user = 'saqlain_at';
//                $database_pass = 'bu78x8g7_fratres';
                $currency = 'AT';
                break;
            case 'pk':
                $database_name = 'saqlain_pk';
                $database_user = 'saqlain_pk';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'pkr';
                break;
            case 'pl':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_pl_poland';
                $database_user = 'saqlain_pl';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'PLN';
                break;
            case 'ro':
                $database_name = 'saqlain_ro_romania';
                $database_user = 'saqlain_ro';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'RON';
                break;
            case 'bg':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_bg_bulgaria';
                $database_user = 'saqlain_bg';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'BGN';
                break;
            case 'lt':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_lt_lithuania';
                $database_user = 'saqlain_lt';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'LTL';
                break;
            case 'ae':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_ae_uae';
                $database_user = 'saqlain_ae';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'AED';
                break;
            case 'sk':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_sk_slovakia';
                $database_user = 'saqlain_sk';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'eur';
                break;
            case 'bl':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_bl_belgium';
                $database_user = 'saqlain_bl';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'eur';
                break;
            case 'fr':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_fr';
                $database_user = 'saqlain_fr';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'eur';
                break;
            case 'ie':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_ie_ireland';
                $database_user = 'saqlain_ie';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'eur';
                break;
            case 'de':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_de_germany';
                $database_user = 'saqlain_de';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'eur';
                break;
            case 'it':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_it_italy';
                $database_user = 'saqlain_it';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'eur';
                break;
            case 'lu':
                $database_name = 'saqlain_lu_luxembourg';
                $database_user = 'saqlain_lu';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'eur';
                break;
            case 'md':
                $database_name = 'saqlain_md_moldova';
                $database_user = 'saqlain_md';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'Leu';
                break;
            case 'no':
                $database_name = 'saqlain_no_norway';
                $database_user = 'saqlain_no';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'NOK';
                break;
            case 'pt':
                $database_name = 'saqlain_pt_portugal';
                $database_user = 'saqlain_pt';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'eur';
                break;
            case 'ru':
                $database_name = 'saqlain_ru_russia';
                $database_user = 'saqlain_ru';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'RUB';
                break;
            case 'es':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_es_spain';
                $database_user = 'saqlain_es';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'eur';
                break;
            case 'se':
                $database_name = 'saqlain_se_sweden';
                $database_user = 'saqlain_se';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'SEK';
                break;
            case 'ch':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_ch_switzerland';
                $database_user = 'saqlain_ch';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'CHF';
                break;
            case 'ua':
                $database_name = 'saqlain_ua_ukraine';
                $database_user = 'saqlain_ua';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'UAH';
                break;
            case 'az':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_az_azerbaijan';
                $database_user = 'saqlain_az_azerbaijan';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'AZN';
                break;
            case 'am':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_am_armenia';
                $database_user = 'saqlain_am_armenia';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'AMD';
                break;
            case 'bd':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_bd_bangladesh';
                $database_user = 'saqlain_bd';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'BDT';
                break;
            case 'cy':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_cy_cyprus';
                $database_user = 'saqlain_cy';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'eur';
                break;
            case 'cn':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_cn_china';
                $database_user = 'saqlain_cn';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'CNY';
                break;
            case 'jp':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_jp_japan';
                $database_user = 'saqlain_jp';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'JPY';
                break;
            case 'kr':
                $database_name = 'saqlain_kr_korea';
                $database_user = 'saqlain_kr';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'KRW';
                break;
            case 'my':
                $database_name = 'saqlain_my_malaysia';
                $database_user = 'saqlain_my';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'MYR';
                break;
            case 'ph':
                $database_name = 'saqlain_ph_philippines';
                $database_user = 'saqlain_ph';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'PHP';
                break;
            case 'lk':
                $database_name = 'saqlain_lka_srilanka';
                $database_user = 'saqlain_lka';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'LKR';
                break;
            case 'th':
                $database_name = 'saqlain_th_thailand';
                $database_user = 'saqlain_th';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'THB';
                break;
            case 'tr':
                $database_name = 'saqlain_tr_turkey';
                $database_user = 'saqlain_tr';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'TRY';
                break;
            case 'bh':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_bh_bahrain';
                $database_user = 'saqlain_bh';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'BHD';
                break;
            case 'kw':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_kw_kuwait';
                $database_user = 'saqlain_kw';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'KD';
                break;
            case 'lb':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_lb_Iebanon';
                $database_user = 'saqlain_lb';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'LL';
                break;
            case 'il':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_il_israil';
                $database_user = 'saqlain_il';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'ILS';
                break;
            case 'qa':
                $database_name = 'saqlain_qa_qatar';
                $database_user = 'saqlain_qa';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'QR';
                break;
            case 'sa':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_ksa_saudi_arabia';
                $database_user = 'saqlain_ksa';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'SAR';
                break;
            case 'ca':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_ca_canada';
                $database_user = 'saqlain_ca';
                $database_pass = 'bu78x8g7_fratres';

//                $database_name = 'saqlain_ca_canada';
//                $database_user = 'saqlain_ca';
//                $database_pass = 'bu78x8g7_fratres';
                $currency = 'cad';
                break;
            case 'br':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_br_brazil';
                $database_user = 'saqlain_br';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'BRL';
                break;
            case 'co':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_co_colombia';
                $database_user = 'saqlain_co';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'COP';
                break;
            case 'cl':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_cl_chile';
                $database_user = 'saqlain_cl';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'CLP';
                break;
            case 'mx':
                $database_name = 'saqlain_mx_mexico';
                $database_user = 'saqlain_mx';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'MXN';
                break;
            case 'us':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_usa';
                $database_user = 'saqlain_us';
                $database_pass = 'bu78x8g7_fratres';

//                $database_name = 'saqlain_usa';
//                $database_user = 'saqlain_us';
//                $database_pass = 'bu78x8g7_fratres';
                $currency = 'usd';
                break;
            case 'vn':
                $database_name = 'saqlain_vn_vietnam';
                $database_user = 'saqlain_vn';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'VND';
                break;
            case 'eg':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_eg_egypt';
                $database_user = 'saqlain_eg';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'EGP';
                break;
            case 'ma':
                $database_name = 'saqlain_mr_morroco';
                $database_user = 'saqlain_mr';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'MAD';
                break;
            case 'ng':
                $database_name = 'saqlain_ng_nigeria';
                $database_user = 'saqlain_ng';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'NGN';
                break;
            case 'za':
                $database_name = 'saqlain_rsa_south_africa';
                $database_user = 'saqlain_rsa';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'ZAR';
                break;
            case 'tz':
                $database_name = 'saqlain_tz_tanzania';
                $database_user = 'saqlain_tz';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'TZS';
                break;
            case 'zw':
                $database_name = 'saqlain_zw_zimbabwe';
                $database_user = 'saqlain_zw';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'ZWL';
                break;
            case 'ug':
                $database_name = 'saqlain_ug_uganda';
                $database_user = 'saqlain_ug';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'UGX';
                break;
            case 'au':
//                $database_host = '185.177.93.231';
                $database_name = 'saqlain_au_australia';
                $database_user = 'saqlain_au';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'AUD';
                break;
            case 'nz':
                $database_name = 'saqlain_nz_newzealand';
                $database_user = 'saqlain_nz';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'NZD';
                break;
            case 'nl':
                $database_name = 'saqlain_nl_netherlands';
                $database_user = 'saqlain_nl';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'eur';
                break;
            case 've':
                $database_name = 'saqlain_ve_venezuela';
                $database_user = 'saqlain_ve';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'VES';
                break;
            case 'sg':
                $database_name = 'saqlain_sg_singapore';
                $database_user = 'saqlain_sg';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'SGD';
                break;
            case 'af':
                $database_name = 'saqlain_af_afghanistan';
                $database_user = 'saqlain_af';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'SGD';
                break;

            default:
                $database_name = 'saqlain_staging';
                $database_user = 'saqlain_ae';
                $database_pass = 'bu78x8g7_fratres';
                $currency = 'AED';
                break;

        }
        if($domain){
            $database_name = 'homestead';
            $database_user = 'root';
            $database_pass = '';
            $currency = 'eur';
        }

        if(config('mail.APP_SEND_EMAIL') != 'local') {
            $database_user = 'saqlain_fratres_accounts';
            $database_pass = 'fratres_accounts';
        }

//        if (ip() == '39.53.104.133') {

//            dd( $database_user );
//        }



// dd( $database_host, $database_name,$database_user, $database_pass,$currency);
        Config::set('database.connections.mysql.host', $database_host);
        Config::set('database.connections.mysql.database', $database_name);
        Config::set('database.connections.mysql.username', $database_user);
        Config::set('database.connections.mysql.password', $database_pass);
        Config::set('services.stripe.currency', $currency);


//        Config::set('database.connections.tracker.host', $database_host);
//        Config::set('database.connections.tracker.database', $database_name);
//        Config::set('database.connections.tracker.username', $database_user);
//        Config::set('database.connections.tracker.password', $database_pass);

//        if( $domain == 'ca' ){
//            $ho = Config::get('database.connections.mysql.host');
//            dd($ho);

//        }

        Config::set('services.stripe.key', $key);
        Config::set('services.stripe.secret', $secret);

        if(ip() == '193.148.18.54'){
        }
//            Config::set('app.debug', true);

    }


    public function switch_analytics_id() {

        $domain = request()->getHttpHost();
        $domain = str_replace(".fratres.net", "", $domain);


        switch ($domain) {
            case 'au':
                $view_id = '214216682';
                break;
             case 'tr':
                $view_id = '215265484';
                break;
            case 'at':
                $view_id = '214399907';
                break;
            case 'bh':
                $view_id = '214894347';
                break;
            case 'bd':
                $view_id = '214233485';
                break;
            case 'bg':
                $view_id = '214577643';
                break;
            case 'br':
                $view_id = '214895961';
                break;
            case 'bl':
                $view_id = '214123453';
                break;
            case 'ca':
                $view_id = '214553688';
                break;
            case 'cl':
                $view_id = '214871121';
                break;
            case 'cn':
                $view_id = '214193782';
                break;
            case 'co':
                $view_id = '214540680';
                break;
            case 'eg':
                $view_id = '214856680';
                break;
            case 'fr':
                $view_id = '214205853';
                break;
            case 'de':
                $view_id = '214565516';
                break;
            case 'ie':
                $view_id = '214221527';
                break;
            case 'in':
                $view_id = '214856983';
                break;
            case 'it':
                $view_id = '214532910';
                break;
            case 'jp':
                $view_id = '214877199';
                break;
            case 'kr':
                $view_id = '214220488';
                break;
            case 'sa':
                $view_id = '214961291';
                break;
                case 'kw':
                $view_id = '214595072';
                break;
            case 'lt':
                $view_id = '214886878';
                break;
            case 'lu':
                $view_id = '214230274';
                break;
            case 'uk':
                $view_id = '214676589';
                break;
            case 'my':
                $view_id = '214581170';
                break;
            case 'mx':
                $view_id = '214984504';
                break;
            case 'mr':
                $view_id = '214204438';
                break;
            case 'nw':
                $view_id = '214570284';
                break;
            case 'ng':
                $view_id = '214980048';
                break;
            case 'no':
                $view_id = '214201394';
                break;
            case 'ph':
                $view_id = '214965451';
                break;
            case 'pk':
                $view_id = '214185329';
                break;
            case 'pl':
                $view_id = '214236579';
                break;
            case 'pt':
                $view_id = '214682390';
                break;
            case 'qa':
                $view_id = '214975737';
                break;
            case 'ro':
                $view_id = '214314150';
                break;
            case 'ru':
                $view_id = '214672189';
                break;
            case 'sg':
                $view_id = '214314369';
                break;
            case 'sk':
                $view_id = '214570617';
                break;
            case 'za':
                $view_id = '214977881';
                break;
            case 'es':
                $view_id = '214285125';
                break;
            case 'lk':
                $view_id = '214658479';
                break;
            case 'se':
                $view_id = '214968238';
                break;
            case 'ch':
                $view_id = '214294420';
                break;
            case 'th':
                $view_id = '214623864';
                break;
            case 'ae':
                $view_id = '214375746';
                break;
            case 'vn':
                $view_id = '214393012';
                break;
            case 've':
                $view_id = '214670305';
                break;
            case 'md':
                $view_id = '214185329';
                break;
            case 'nl':
                $view_id = '214185329';
                break;
            case 'tz':
                $view_id = '214185329';
                break;
            case 'ug':
                $view_id = '214185329';
                break;
            case 'ua':
                $view_id = '214185329';
                break;
            case 'zw':
                $view_id = '214185329';
                break;
            case 'us':
                $view_id = '215268646';
                break;


            default:
                $view_id = '214185329';
                break;

        }


        Config::set('analytics.view_id', $view_id);
    }

}
