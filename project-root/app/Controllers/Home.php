<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $css = [
            'file_1' => 'home'
        ];

        $dynamic_details = [
            'files' => $css,
            'title' => 'Home',
        ];

        return view('home', $dynamic_details);
    }

    public function test()
    {
        return view('test');
    }
}
