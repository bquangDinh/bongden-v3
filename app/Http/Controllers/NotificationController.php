<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\NotificationService;

class NotificationController extends Controller
{
    public function mark_as_read_notification($notification_id){
      NotificationService::mark_as_read_notification($notification_id);
      return 0;
    }
}
