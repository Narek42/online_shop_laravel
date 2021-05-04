<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsModel;


class SearchController extends Controller
{
    function search(Request $request)
    {
        $search = ProductsModel::where("name", "like", $request->name."%")->get();
        return redirect("/profile")->with("data_list", $search);
    }
}
