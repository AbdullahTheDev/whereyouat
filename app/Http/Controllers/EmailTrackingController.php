<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\EmailLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailTrackingController extends Controller
{
    function sendEmail(){
        $emailLog = EmailLog::create([
            'recipient_email' => 'dev@uniquelogodesigns.com',
            'sent_at' => now(),
        ]);
        $sendMail = Mail::to('dev@uniquelogodesigns.com')->send(new TestMail($emailLog->id));
        
        return 'sent';
    }
    public function trackEmail($id)
    {
        // Log the email as opened
        $emailLog = EmailLog::find($id);
        if ($emailLog) {
            $emailLog->opened_at = now();
            $emailLog->save();
        }

        // Return a transparent 1x1 GIF
        $transparentGif = base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
        return response($transparentGif, 200)->header('Content-Type', 'image/gif');
    }
}
