<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscription;

class PricingController extends Controller
{
    public function Index()
    {
        $return_data['subscription_plans'] = Subscription::where('deleted', '1')->where('status', '1')->get();
        $return_data['site_title'] = trans('Match') ;

        return view('front.pricing.index', array_merge($return_data));
    }
}
