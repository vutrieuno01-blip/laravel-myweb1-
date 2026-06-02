<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //

    public function index4($id)
    {
        $data = "ABC";
        dump($id);
        // Sử dụng compact để truyền biến $data và $id sang view
        return view('demoindex4', compact('data', 'id'));
    }
}
