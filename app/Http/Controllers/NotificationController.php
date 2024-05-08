<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        //$notifications = Notification::latest()->get();

        $user = request()->user();
        
        $latest = $user->unreadNotifications->first();

        return response()->json($latest->id);
    }
}
