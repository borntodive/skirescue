<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function ws()
    {
        event(new \App\Events\TestEvent());
        return 'ok';
    }
}
