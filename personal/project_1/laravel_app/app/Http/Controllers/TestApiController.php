<?php

namespace App\Http\Controllers;

use App\Models\TestApi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TestApiController extends Controller
{
    public function index(request $request) {
        $something = $request->input("something");
        if ($something != null) {
            $source = TestApi::where("name", "like", "%$something%")->orWhere("profession", "like", "%$something%")->paginate(10);
        } else {
            $source = TestApi::orderBy("id", "desc")->paginate(10);
        }
        return json_encode($source);
    }

    public function save(request $request){
        $data = $request->all();
        $data["name"] = ucwords($data["name"]);
        unset($data["id"]);
        if ($request->id == null) {
            TestApi::create($data);
        } else {
            TestApi::where("id", $request->id)->update($data);
        }
        return json_encode($data);
    }

    public function delete($data_id){
        TestApi::where("id", $data_id)->delete();
    }
}
