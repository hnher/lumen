<?php

namespace App\Http\Controllers;


class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 测试接口连通性
     * @return array
     */
    public function index() : array
    {
        return [
            'datetime' => date('Y-m-d H:i:s')
        ];
    }
}
