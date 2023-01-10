<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $dynamic_details = [
            'display_header_links' => 1
        ];

        return view('user/home', $dynamic_details);
    }
}
