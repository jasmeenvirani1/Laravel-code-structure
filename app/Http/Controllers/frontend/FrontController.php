<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function Index()
    {

        $return_data['site_title'] = trans('Explore Fitness') ;

        return view('front.faq.index', array_merge($return_data));
    }

    public function GetSupport()
    {
        $return_data['site_title'] = trans('Support') ;

        return view('front.support.index', array_merge($return_data));
    }
}
