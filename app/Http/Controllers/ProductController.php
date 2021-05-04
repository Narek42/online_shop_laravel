<?php

namespace App\Http\Controllers;

use App\Models\ProductsModel;
use App\Models\UnavailableModel;
use App\Models\UsersModel;
use App\Models\CardModel;
use App\Models\BayProductsModel;
use App\Models\CatalogModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\FeedbackModel;

class ProductController extends Controller
{
    function main()
    {
        $all_products = ProductsModel::orderBy("id", "DESC")->get();
        foreach ($all_products as $item) {
            $item->photo = json_decode($item->photo);
            $item->glav_photo = $item->photo[0];
        }
        return view("main", ["products" => $all_products]);
    }
    function get_products()
    {
        $user = Session::get("user");
        $products = ProductsModel::all();
        // $catalog = CatalogModel::all();
        // foreach ($catalog as $key => $item) {
        //     $x = ProductsModel::where("catalog_id", $item->id)
        //     // ->limit(2)
        //     ->get();
        //     foreach ($x as $value) {
        //         array_push($products, $value);
        //     }
        // }
        foreach ($products as $item) {
            $item->photo = json_decode($item->photo);
            $item->glav_photo = $item->photo[0];
            $item->seller = $item->seller;
        }
        // for ($i = 0; $i < count($products); $i++) {
        //     $is_card = CardModel::where("user_id", Session::get("user")->id)
        //                             ->where("product_id", $products[$i]->id)
        //                             ->get();
        //     count($is_card) > 0 ? $products[$i]["is_card"] = true : $products[$i]["is_card"] = false;
        // }
        return $products;
    }
    function add_product()
    {
        $user = Session::get("user");
        $categories = CatalogModel::all();
        return view("add_product", ["user"=>$user, "categories"=>$categories]);
    }
    function adding_product(Request $request)
    {
        $validator = Validator::make([
            "name" => $request->name,
            "price" => $request->price,
            "quantity" => $request->quantity,
            "photo" => $request->photo,
            "categories" => $request->categories,
        ], [
            "name" => "required",
            "price" => "required|integer",
            "quantity" => "required|integer",
            // "photo" => "required|image|mimes:jpeg,png,jpg,gif,svg",
            "categories" => "required",
        ]);
        if ($validator->fails()) {
            return redirect("/seller/addProduct")->withErrors($validator, "adding_product");
        }
        $images = array();
        if  ($request->hasFile("photo")) {
            $images = $request->file("photo");
            $destinationPath = public_path('/images');
            foreach ($images as $index => $image) {
                $images[$index] = time().$image->getClientOriginalName();
                $image->move($destinationPath, $images[$index]);
            }
            $images = json_encode($images);
            // $name  = time().'.'.$image->getClientOriginalExtension();
            // $destinationPath = public_path('/images');
            // $image->move($destinationPath, $name);
            // $request->photo = $name;
            $product = new ProductsModel();
            $product->name = $request->name;
            $product->user_id = Session::get("user")->id;
            $product->catalog_id = $request->categories;
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->photo = $images;
            $product->comment = $request->comment;
            $product->valuta  = $request->valuta;
            $product->save();
            return redirect("/seller/myProducts");
        }
    }
    function seller_details_product($id)
    {
        $details = ProductsModel::find($id);
        $my_products = ProductsModel::where("user_id", Session::get("user")->id)
            ->get();
            $details->photo = json_decode($details->photo);
            $details->glav_photo = $details->photo[0];

        foreach ($my_products as $item) {
            $item->photo = json_decode($item->photo);
            $item->glav_photo = $item->photo[0];
        }
        $is_unavailable = UnavailableModel::where("user_id", Session::get("user")->id)
                            ->where("product_id", $id)
                            ->get();
        return view("seller_details_product", [
            "product" => $details,
            "my_products" => $my_products,
            "is_unavailable" => count($is_unavailable) > 0 ? 1 : 0
        ]);
    }
    function my_products()
    {
        $user = Session::get("user");
        $my_product = $this->get_myproducts($user->id);
        foreach ($my_product as $item) {
            $item->photo = json_decode($item->photo);
            $item->glav_photo = $item->photo[0];
        }
        return view("my_products", ["user"=>$user, "my_products" => $my_product]);
    }
    function check_status($arr)
    {
        for ($i = 0; $i < count($arr); $i++) {
            $arr[$i]->is_unavailable = count(UnavailableModel::where("user_id", Session::get("user")->id)
                ->where("product_id", $arr[$i]->id)
                ->get());
        }
        return $arr;
    }
    function chack_status_without_product_id($arr)
    {
        for ($i = 0; $i < count($arr); $i++) {
            $arr[$i]->is_unavailable = count(UnavailableModel::where("product_id", $arr[$i]->id)
                ->get());
        }
        return $arr;
    }
    function get_myproducts($id)
    {
        $my_product = ProductsModel::where(["user_id" => $id])->orderBy("id", "DESC")->get();
        $my_product = $this->check_status($my_product);
        return $my_product;
    }
    function filter_by_seller($id)
    {
        $user = UsersModel::find($id)->products()->get();
        foreach ($user as $item) {
            $item->photo = json_decode($item->photo);
            $item->glav_photo = $item->photo[0];
        }
        $arr = array("products" =>  $user);

        for ($i = 0; $i < count($user); $i++) {
            $is_card = CardModel::where("user_id", Session::get("user")->id)
                                    ->where("product_id", $user[$i]->id)
                                    ->get();
            count($is_card) > 0 ? $user[$i]["is_card"] = true : $user[$i]["is_card"] = false;
        }
        return view("seller_filter", $arr);
    }
    function get_product_details($id)
    {
        // dd(Session::get("user"));

        $details = ProductsModel::find($id);
        $categories = ProductsModel::where("catalog_id", $details->catalog_id)
        ->where("id","!=", $details->id)
        ->get();
        $details->photo = json_decode($details->photo);
        $details->glav_photo = $details->photo[0];

        foreach ($categories as $item) {
            $item->photo = json_decode($item->photo);
            $item->glav_photo = $item->photo[0];
        }
        $details = $this->chack_status_without_product_id(array($details));

        $arr = array("product" => $details[0], "categories"=>$categories);
        $arr["feedback"] = FeedbackModel::where("product_id", $id)->get();
        for ($i=0; $i < count($arr["feedback"]); $i++) {
            $arr["feedback"][$i]["writed"] = UsersModel::select("name", "surname")->find($arr["feedback"][$i]["user_id"]);
        }
        if  (Session::get("user")) {
            $is_buyed = BayProductsModel::where("user_id", Session::get("user")->id)
            ->where("product_id", $id)
            ->first();
            $is_card =  CardModel::where("user_id", Session::get("user")->id)
                    ->where("product_id", $id)
                    ->get();
            count($is_card) > 0 ? $arr["is_card"] = true : $arr["is_card"] = false;
            $arr["is_buyed"] = $is_buyed ? 1 : 0;
            $arr["guest"] = 0;
        } else  {
            $arr["guest"] = 1;
            $arr["is_card"] = false;
            $arr["is_buyed"] = 0;
        }
        return view("details", $arr);
    }
    function guest_product_details($id)
    {
        $product = ProductsModel::find($id);
        $product->photo = json_decode($product->photo);
        $product->glav_photo = $product->photo[0];
        $product->sell = $product->seller;
        $categories = ProductsModel::where("catalog_id", $product->catalog_id)
                    ->where("id", "!=", $id)
                    ->get();
        foreach ($categories as $item) {
            $item->photo = json_decode($item->photo);
            $item->glav_photo = $item->photo[0];
        }
        $product->categories = $categories;
        return view("guest_product_details", $product);
    }
    function guest_filter_by_seller($id)
    {
        $products = ProductsModel::where("user_id", $id)->get();
        foreach ($products as $item) {
            $item->photo = json_decode($item->photo);
            $item->glav_photo = $item->photo[0];
        }
        return view("guest_filter_byseller", ["products" => $products]);
    }
    function edit_product($id)
    {
        $product = ProductsModel::where("id", $id)->get()->first();
        $categories = CatalogModel::all();
        $product->catalog = CatalogModel::where("id", $product->catalog_id)->get()->first()->name;
        $product->photo = json_decode($product->photo);
        $product->glav_photo = $product->photo[0];
        Session::put("edit_id", $id);
        return view("edit_product", ["product"=>$product, "categories" => $categories]);
    }
    function edit_product_adding(Request $request)
    {
        $validator = Validator::make([
            "name" => $request->name,
            "price" => $request->price,
            "quantity" => $request->quantity,
            "photo" => $request->photo,
            "categories" => $request->categories,
        ], [
            "name" => "required",
            "price" => "required|integer",
            "quantity" => "required|integer",
            // "photo" => "required|image|mimes:jpeg,png,jpg,gif,svg",
            "categories" => "required",
        ]);
        if ($validator->fails()) {
            return redirect("/product/edit/25")->withErrors($validator, "adding_product");
        }
        $images = array();
        if  ($request->hasFile("photo")) {
            $images = $request->file("photo");
            $destinationPath = public_path('/images');
            foreach ($images as $index => $image) {
                $images[$index] = time().$image->getClientOriginalName();
                $image->move($destinationPath, $images[$index]);
            }
            $images = json_encode($images);
            ProductsModel::where("id", $request->id)->update([
                "name"=>$request->name,
                "catalog_id"=>$request->categories,
                "price"=>$request->price,
                "photo"=>$images,
                "quantity"=>$request->quantity,
                "valuta"=>$request->valuta,
                "comment"=>$request->comment,
            ]);
            $request->id = Session::get("edit_id");
            return redirect("/product/edit/$request->id");
        }
    }

    function show_images(Request $request) {
        dd($request);
    }

    function delete_product($id)
    {
        $product = ProductsModel::find($id);
        $product->delete();
        return redirect("/seller/myProducts");
    }
    function is_unavailable($id)
    {
        $obj = new UnavailableModel();
        $obj->user_id = Session::get("user")->id;
        $obj->product_id = $id;
        $obj->save();
        return redirect()->to("/seller/details/product/$id");
    }
    function is_available($id)
    {
        UnavailableModel::where("user_id", Session::get("user")->id)
                        ->where("product_id", $id)
                        ->delete();
        return redirect()->to("/seller/details/product/$id");
    }
    function get_catalogs()
    {
        $catalog = CatalogModel::all();
        return $catalog;
    }
    function filter_with_catalog($id )
    {
        $products = ProductsModel::where("catalog_id", $id)->get();
        foreach ($products as $item) {
            $item->photo = json_decode($item->photo);
            $item->glav_photo = $item->photo[0];
            $item->seller = $item->seller;
        }
        return $products;
    }
    function add_feedback(Request $request, $p_id, $u_id)
    {
        // dd(func_get_args());
        if  (!$request->selStar || !$request->review) {
            return redirect()->back()->withErrors("Rate the product!", "msg_star");
        }
        $feedback = new FeedbackModel();
        $feedback->user_id = $u_id;
        $feedback->product_id = $p_id;
        $feedback->stars = $request->selStar;
        $feedback->review = $request->review;
        $feedback->save();
        return redirect()->back();
    }
}
