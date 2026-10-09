<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders(){
      $user=auth()->user();
      $products=$user->purchasedBooks;
      return view('orders',compact('products'));

    }

    public function allOrders(){
      
      $products=Orders::where('bought',1)->orderBy('created_at')->get();
      return view('admin.orders.orders',compact('products'));
    }
}
