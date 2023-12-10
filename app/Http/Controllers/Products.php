<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Products extends Controller
{

    public function index($id=null){
        $search = request("search");
        if($id!=null){
            return view("/product",["id"=>$id]);
        }else {
            return view("/Products",["search"=>$search]);
        }
    }

}
