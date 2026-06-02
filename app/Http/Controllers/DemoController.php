<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function index3()
{
    return response()->json([
        'status' => true,
        'data' => [
            'name' => 'Sản phẩm 1',
            'price' => 240000
        ]
    ]);
}
    public function index5($id = null) // Gán mặc định là null
{
    $data = "ABC"; 
    return view('demoindex5', compact('data', 'id'));
}
public function index6($parram1, $parram2)
{
    $data = "ABC"; 
    // Truyền cả 3 biến sang view bằng hàm compact
    return view('demoindex6', compact('data', 'parram1', 'parram2'));
}
}
