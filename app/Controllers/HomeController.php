<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        $data = array(
            "title" => "Página inicial"
        );

        return view('index', $data);
    }
}
