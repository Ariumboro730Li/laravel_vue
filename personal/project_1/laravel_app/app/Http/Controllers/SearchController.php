<?php

namespace App\Http\Controllers;

use App\Models\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index($search){
        $alldata = Search::where("value", "like", "%$search%")->get();
        $results = [];
        foreach ($alldata as $key => $data) {
           $results[] = $data->value;
        }

        return json_encode($results);
    }
}
