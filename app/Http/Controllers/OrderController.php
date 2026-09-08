<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showOrderDetails(Request $request, $id)
    {
        if ($id === 'current') {
            $currentOrder = $request->session()->get('current_order', []);
            return view('invoice', [
                'isCurrent'     => true,
                'current_order' => $currentOrder
            ]);
        }
    }
}