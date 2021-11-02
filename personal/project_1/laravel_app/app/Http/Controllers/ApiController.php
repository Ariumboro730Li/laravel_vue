<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index() {
        $data = [
            "name" => "Ari Umboro Seno",
            "profession" => "Programmer"
        ];

        return $data;
    }
}
