<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @return array
     */
    public function index()
    {
        return [
            'datetime' => date('Y-m-d H:i:s', time())
        ];
    }
}
