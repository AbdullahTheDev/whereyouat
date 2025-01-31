<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead(Request $request)
    {
        $notification = Notification::find($request->id);

        if ($notification) {
            $notification->update(['status' => 0]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
