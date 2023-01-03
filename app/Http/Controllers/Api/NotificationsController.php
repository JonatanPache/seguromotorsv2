<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;

class NotificationsController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function updateNotification(Request $request)
    {
        auth()->user()->update(['notification_token' => $request->notification_token]);
        return $this->sendResponse(auth()->user(),'Actualizado token exitosamente');
    }

    public function saveToken(Request $request)
    {
        //auth()->user()->update(['device_token'=>$request->token]);
        auth()->user()->update(['notification_token'=>$request->token]);
        return response()->json(['token saved successfully.']);
    }

    public function sendNotification(Request $request)
    {
        //$firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
        $firebaseToken=['cJJXZxbSSnGf2CLZbDj32_:APA91bGeNCklYIi6ZXoIUO5j7XoWdAXm-vT2QlXMMuKoPJVCZn3H9fPmiP3yt3hINL0jJR2oICUOwT0Brf7RPi3PiKSnyr40_b62LQ6upW1SHl33bbUk2dhgVqvXHNcUZfz3PTFr7x3Q'];

        //$firebaseToken=['cSObltjfRjq1KZYz2mh5ug:APA91bGiiGUCYmp4hDt0OguP8U4dm0c4pXYm4zIZep6yW1UHsKUnv3PmQQozN6p6SqYE8x4rOLobS5HgRrdJNRQj0AAwKSjpFub6y6l5Ogiq_hB5qc3kynLbNCpk20AUAnkYMwNHw9oK'];
        $SERVER_API_KEY = 'AAAAor5MgwI:APA91bFCFKxMfvxqdaDzT16XLo7wU_Wp__t_FGpavMqiSmw1sty1fhffWSa9ezrg1rrTHLX6Ur_idSvIQXah4fwBCcxE8BDFndTq8OeEaEJ4TNblVahgeVmuBCKihRcDBVVZckdc77fi';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
                "content_available" => true,
                "priority" => "high",
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

        dd($response);
    }
}
