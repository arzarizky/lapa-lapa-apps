<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseApi;
use App\Models\Notifikasi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $datawaktu = Notifikasi::select('time')->distinct()->get();
        $datas = [];
        $datas['waktu'] = [];
        foreach ($datawaktu as $key => $value) {
            if ($value->time == Carbon::now()->format('Y-m-d')) {
                $kondisihari = "Hari Ini";
            } else {
                $kondisihari = "Hari Kemarin";
            }

            $data = ['time' => $value->time, 'Kondisihari' => $kondisihari];
            array_push($datas['waktu'], $data);
        }

        foreach ($datas['waktu'] as $keywaktu => $valuewaktu) {
            $datas['waktu'][$keywaktu]['pesan'] = Notifikasi::where('time', $valuewaktu)->get();
            foreach ($datas['waktu'][$keywaktu]['pesan'] as $keywaktupesan => $valuewaktupesan) {
                $waktunya = $valuewaktupesan->created_at;
                $waktunya2 = $waktunya->diffForHumans();
                $valuewaktupesan->timenya = $waktunya2;
            }
        }
        return ResponseApi::success($datas);
    }

    public static function pushnotif($title, $body)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        // $FcmToken = User::whereNotNull('device_key')->pluck('device_key')->all();

        $serverKey = env('FIREBASE');

        $data = [
            "to" => "/topics/global",
            "notification" => [
                "content_available" => true,
                "priority" => "high",
                "title" => $title,
                "body" => $body,
            ],
            "data" => [
                "content_available" => true,
                "priority" => "high",
                "title" => $title,
                "body" => $body,
            ]

        ];

        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        // FCM response
        return ResponseApi::success($result);
    }
}
