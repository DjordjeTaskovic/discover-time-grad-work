<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public $data;

    
    public function __construct()
    {
        $this->data["menu"] = [];
        $this->data['notifi_menu'] = Notification::getAll();
      
    }
}
