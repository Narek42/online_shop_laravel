<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CardModel;
use App\Models\UnavailableModel;
use App\Models\BayProductsModel;
use Illuminate\Support\Facades\Session;



class CardController extends Controller
{
    function profile_card($id)
    {
        $obj = new CardModel();
        $obj->product_id = $id;
        $obj->user_id = Session::get("user")->id;
        $obj->qanak = 1;
        $obj->save();
        return redirect()->back();
    }
    function chack_status_without_product_id($arr)
    {
        for ($i = 0; $i < count($arr); $i++) {
            $arr[$i]->is_unavailable = count(UnavailableModel::where("product_id", $arr[$i]->product_id)
                ->get());
        }
        return $arr;
    }
    function card()
    {
        $total = 0;
        $products = CardModel::where("user_id", Session::get("user")->id)->orderBy("id", "DESC")->get();
        $products = $this->chack_status_without_product_id($products);
        $products = $this->is_buyed($products);
        foreach ($products as $item) {
            $item->product->photo = json_decode($item->product->photo);
            $item->glav_photo = $item->product->photo[0];
            if  ($item->is_unavailable == 0) {
                if ($item->is_buyed) {
                    $total += $item->is_buyed;
                } else {
                    $total += $item->product->price;
                }
            }
        }
        // dd($products);
        return view("profile_card", ["products" => $products, "total" => $total]);
    }
    function is_buyed($arr)
    {
        // $is_first = BayProductsModel::select("product_id")->where("user_id", Session::get("user")->id)->get()->first();
        // if  (!$is_first) {
        //     return $arr;
        // }
        // $is_first = json_decode($is_first->products);
        // foreach ($arr as $item) {
        //    foreach ($is_first as $id) {
        //        if ($item->product_id == $id) {
        //            $item->is_buyed = $item->product->price - ($item->product->price * 10 / 100);
        //        }
        //    }
        // }
        return $arr;
    }
    function delete_in_card($id)
    {
        CardModel::where("user_id", Session::get("user")->id)
            ->where("product_id", $id)
            ->delete();
            return back();
    }
}
