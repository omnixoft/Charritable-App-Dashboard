<?php


if (!function_exists('thawaniPayment')) {
    function thawaniPayment($thawani_url, $customer_id, $type, $amount, $name, $key, $publish)
    {

        $url = $thawani_url . "api/v1/checkout/session";
        $data = [

            "client_reference_id" =>  $customer_id,
            "mode" =>  "payment",
            "products" =>  [
                [
                    "name" =>  trim($type),
                    "quantity" =>  1,
                    "unit_amount" =>  $amount * 1000
                ]

            ],
            "success_url" =>  'https://company.com/success',
            "cancel_url" =>  'https://company.com/cancel',
            "save_card_on_success" =>  false,
            "metadata" =>  (object)[
                "customerName" => $name,

            ]

        ];
        // $ch = curl_init($url);
        $payload = json_encode($data);
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "thawani-api-key: " . $key
            ],
        ]);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);
        $data = json_decode($response, TRUE);

        $err = curl_error($curl);
        curl_close($curl);
        // echo  $response;
        if (isset($data['code']) && $data['code'] == 2004) {
            $payUrl = $thawani_url . 'pay/' . $data['data']['session_id'] . '?key=' . $publish;
            // header("Location: " . $payUrl);
            return $payUrl;
        } else {
            return $data;
        }
    }
}




if (!function_exists('sendSms')) {
    function sendSms($to, $message)
    {

        $curl = curl_init();
        // $to = urlencode($to);
        $message = urlencode($message);
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://api.smscountry.com/SMSCwebservice_bulk.aspx?User=ramzoman&passwd=Ramz*951&mobilenumber=' . $to . '&message=' . $message . '&mtype=N&DR=Y',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
    }
}
if (!function_exists('baseToImg')) {
    function baseToImg($img, $id = '')
    {

        $img  = base64_decode($img);
        $safeName = $id . rand(1, 50) . '_.' . 'png';
        Storage::disk('public')->put('images/' . $safeName, $img);
        return $safeName;
    }
}


if (!function_exists('CurlApi')) {
    function CurlApi($url, $apiKey, $body)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => array(
                'Content-type: application/json',
                'Thawani-Api-Key: ' . $apiKey
            ),
        ));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}


if (!function_exists('pushNotification')) {
    function pushNotification($title, $body, $firebaseToken)
    {

        $SERVER_API_KEY = 'AAAAMcmp2aU:APA91bGVjLB8TdevBUabwncdzd1CSGnyARovbfowzgLIbUg0acuhal_L19XalBcCgUS3Cs_OZKYQY-HlWJS42D5ugwMksZ7Bm3FfYbeKkB4xJuRRvp_PoEhwbn8glI4eJA2BwpTkb7bz';

        $data = [
            "to" => $firebaseToken,
            "notification" => [
                "title" => $title,
                "body" => $body,
                "content_available" => true,
                "priority" => "high",
                "icon" => "/logo.png",
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        // dd($response);

    }
}
if (!function_exists('webNotification')) {
    function webNotification($title, $msg, $user_id)
    {
        $alert = new App\Models\UserAlert();
        $alert->title = $title;
        $alert->alert_text = $msg;
        $alert->created_by_id = $user_id;
        $alert->save();
        \DB::insert('insert into user_user_alert (user_alert_id,user_id) values (?, ?)', [$alert->id, 1]);
    }
}

if (!function_exists('sendNotifiction')) {

    function sendNotifiction($title, $body, $token)
    {

        $SERVER_API_KEY = 'AAAAZgTsJro:APA91bGTwekMPVJQQpPaJCc6ktrHYN-rWlnYYiSl9Jsh6f1S-Yyvece-v5Q0ZdL_kg1dI-cxq2F5fIyuPcXgvtmTb4NxknM_Li1T0zKKc74iM6y4a5TnY3kJrTqGvLGQE4cNZwmksFo5';
        $data = [
            "to" => $token,
            "notification" => [
                "title" => $title,
                "body" => $body,
                "content_available" => true,
                "priority" => "high",
                "sound" => "default",
                // "android_channel_id"=>"guard-system"
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        // dd($response);
    }
}

if (!function_exists('sendNotifictionTopic')) {
    function sendNotifictionTopic($title, $body, $token)
    {

        // $title=$res['notification_title'];
        // $body=$res['notification_body'];
        // $token=$res['token'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "to": "/topics/' . $token . '",
            "notification": {
        
                "title": "' . $title . '",
                "body": "' . $body . '",
               "priority": "high",
               "sound": "default",
                "content-available" : 1,
                "android_channel_id": "oman-charity-app"},
          "data": {
                "notification_type": ""
            }
        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: key=AAAAZgTsJro:APA91bGTwekMPVJQQpPaJCc6ktrHYN-rWlnYYiSl9Jsh6f1S-Yyvece-v5Q0ZdL_kg1dI-cxq2F5fIyuPcXgvtmTb4NxknM_Li1T0zKKc74iM6y4a5TnY3kJrTqGvLGQE4cNZwmksFo5'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
    }
}
if (!function_exists('validate_req')) {
    function validate_req($request, $param)
    {
        foreach ($param as $p) {
            // echo $p;
            if (!isset($request->$p)) {
                echo json_encode(['Param' => $p . ' parameter is missing']);
                exit;
            }
        }
    }
}

if (!function_exists("timeDifference")) {
    function timeDifference($time1, $time2)
    {
        $d1 =  strtotime($time1);
        $d2 =  strtotime($time2);
        return round(abs($d2 - $d1) / 60, 2);
        // $interval = $d1->diff($d2);
        // $minutes = 0;
        // $minutes += $interval->h * 60;
        // $minutes += $interval->i;
        // return $minutes;
        // $diffInSeconds = $interval->s; //45
        // $diffInMinutes = $interval->i; //23
        // $diffInHours   = $interval->h; //8
        // $diffInDays    = $interval->d; //21
        // $diffInMonths  = $interval->m; //4
        // $diffInYears   = $interval->y; //1
    }

    if (!function_exists('getNum')) {
        function getNum($num)
        {
            return '(+968) ' . $num;
        }
    }
    if (!function_exists('getNum1')) {
        function getNum1($num)
        {
            return '<span class="text-info">(+968) ' . $num . '</span>';
        }
    }
    if (!function_exists('getOmr')) {
        function getOmr($num)
        {
            return $num . ' OMR';
        }
    }
    if (!function_exists('getOmr1')) {
        function getOmr1($num)
        {
            return '<span class="text-info">' . $num . ' OMR</span>';
        }
    }
    if (!function_exists('is_check')) {
        function is_check($check)
        {
            return $check == 1 ? 'checked' : null;
        }
    }
    if (!function_exists('getSort')) {
        function getSort($arr)
        {
            function my_sort($a, $b)
            {
                if ($a == $b) return 0;
                return ($a < $b) ? -1 : 1;
            }
            $a = $arr;
            usort($a, "my_sort");
            $arrlength = count($a);
            for ($x = 0; $x < $arrlength; $x++) {
                echo $a[$x];
            }
        }
    }
    if (!function_exists('getSort')) {
        function sorting()
        {
            $sort_arr = array();
            foreach ($new_arr as $key => $row) {
                $sort_arr[$key] = $row['isStoreTime'];
            }
            array_multisort($sort_arr, SORT_DESC, $new_arr);
        }
    }
}