<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Order;
use App\Models\User;

class ReferralController extends Controller
{
    public function ViewReferral(){

    	//return Auth::id();
        $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->get();
        $test_users = User::all();

        return view('frontend.user.referral.referral_view',compact('orders','test_users'));
    } // end method 
}
