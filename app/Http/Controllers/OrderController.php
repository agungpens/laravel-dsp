<?php

namespace App\Http\Controllers;

use App\Events\OrderShipped;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function ship($order)
    {
        // Logic untuk mengirim order...

        event(new OrderShipped($order));
    }
}
