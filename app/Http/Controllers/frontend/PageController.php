<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    public function Index($slug)
    {
        $return_data['page_data'] = Page::where('slug',$slug)->where('deleted','1')->take(1)->get(['title','description']);
        if(isset($return_data['page_data'][0])){
            $title = $return_data['page_data'][0]->title;
        }else{
            $title = '';
        }

        $return_data['site_title'] = trans($title) ;

        return view('front.page.index', array_merge($return_data));
    }
}
