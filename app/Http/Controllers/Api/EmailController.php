<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Email\SendRequest;
use App\Mail\Api\Email\Send;
use App\Models\EmailLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /**
     * @param SendRequest $request
     * @return JsonResponse
     */
    public function send(SendRequest $request)
    {
        $message = $request->get('message');

        $emailLog = EmailLog::query()->create([
            'message' => $message,
            'user_id' => $request->user()->id,
        ]);

        try {
            Mail::to(config('app.receiver_email'))
                ->queue(new Send($message, $emailLog->id));

            return response()->json(["success" => true, "message" => "The Email sending added in queue"]);
        } catch (\Exception $e) {
            $emailLog->update(['status' => EmailLog::UNDELIVERED]);

            return response()->json(["success" => false, "message" => "Something wrong with email sending"]);
        }
    }
}
