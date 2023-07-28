<?php

namespace App\Services;

class SmsService
{

    public static function callTo($phone, $ip, $active = false) // false -> для теста (код 0000)
    {
        $result = [];
        if ($active == true) {
            $ch = curl_init("https://sms.ru/code/call");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
                "phone" => $phone,
                "ip" => $ip,
                "api_id" => "AF091A73-77E1-9945-9455-280D8014D741"
            )));

            $body = curl_exec($ch);
            curl_close($ch);

            $result = json_decode($body);
        } else {
            $result = (object) array('status' => 'OK', 'code' => 0000);
        }

        return $result;
    }

    public static function sendTo($phone, $message, $active = true)
    {
        $result = [];

        if ($active == true) {

            $ch = curl_init("https://sms.ru/sms/send");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
                "api_id" => "AF091A73-77E1-9945-9455-280D8014D741",
                "to" => $phone, // До 100 штук до раз
                "msg" => $message, // Если приходят крякозябры, то уберите iconv и оставьте только "Привет!",
                "json" => 1,
            )));

            $body = curl_exec($ch);
            curl_close($ch);

            $result = json_decode($body);
        } else {
            $result = (object) array('status' => 'OK', 'code' => 000000);
        }

        return $result;
    }
}
