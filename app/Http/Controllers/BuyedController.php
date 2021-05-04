<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BayProductsModel;
use App\Models\ProductsModel;
use App\Models\UnavailableModel;

use Illuminate\Support\Facades\Session;


class BuyedController extends Controller
{
    function chack_status_without_product_id($arr)
    {
        for ($i = 0; $i < count($arr); $i++) {
            $arr[$i]->is_unavailable = count(UnavailableModel::where("product_id", $arr[$i]->id)
                ->get());
        }
        return $arr;
    }
    function buyed()
    {
        $products = array();
        $id = BayProductsModel::where("user_id", Session::get("user")->id)->get();

        foreach ($id as $item) {
                array_push($products, ProductsModel::where("id", $item->product_id)->get()[0]);
        }
        foreach ($products as $item) {
            $item->photo = json_decode($item->photo);
            $item->glav_photo = $item->photo[0];
        }
        $products = $this->chack_status_without_product_id($products);
        return view("buyed", ["products" => $products]);
    }
}
