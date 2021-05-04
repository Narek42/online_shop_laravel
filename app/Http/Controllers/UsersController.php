<?php

namespace App\Http\Controllers;

use App\Models\CardModel;
use App\Models\CatalogModel;
use App\Models\UnavailableModel;
use App\Models\UsersModel;
use App\Models\BlockModel;
use App\Models\ProductsModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    function sign_up(Request $request)
    {
        $validator = Validator::make([
            "name" => $request->name,
            "surname" => $request->surname,
            "email" => $request->email,
            "password" => $request->password,
            "confirmpass" => $request->confirmpass,
        ], [
            "name" => "required",
            "surname" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:6",
            "confirmpass" => "required|min:6",
        ]);
        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->to("/")->withErrors($validator, "signup");
        }
        $users = new UsersModel();
        $users->name = $request->name;
        $users->surname = $request->surname;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        if  ($request->password != $request->confirmpass) {
            return redirect("/")->with("false_password", "Confirm Password is not true");
        }
        if (isset($request->seller)) {
            $users->type = 1;
        } else {
            $users->type = 0;
        }
        $users->save();
        return redirect()->to("/profile")->with("id", $users->id);
    }
    function login(Request $request)
    {
        $validator = Validator([
            "email" => $request->email,
            "password" => $request->password,
        ], [
            "email"=>"required",
            "password"=>"required"
        ]);
        if  ($validator->fails()) {
            return redirect()->to("/")->withErrors($validator, "login");
        }
        $user = UsersModel::where("email", $request->email)->get();
        if  (count($user) > 0) {
            $user = $user->first();
            $password_h = Hash::check($request->password, $user->password);
            if ($password_h) {
                Session::put("user", $user);
                $date = date('Y-m-d H:i');
                UsersModel::where("id", $user->id)->update(["input"=>$date]);
                $is_blocked = BlockModel::select("time")->where("user_id", $user->id)->first();
                if ($is_blocked && $is_blocked->time > getdate()["0"]) {
                    return redirect("/blocked");
                } else {
                    BlockModel::where("user_id", $user->id)->delete();
                    if  ($user->type == 0) {
                        return redirect("/profile");
                    } else if ($user->type == 1) {
                        return redirect("/seller");
                    } else if ($user->type == 2) {
                        return redirect("/admin");
                    }
                }
            }   else {
                return redirect("/")->with("error_password", "Password is wrong!");
            }
        }   else {
            return redirect("/")->with("error_login", "Login is wrong!");
        }
    }
    function profile()
    {
        $user = Session::get("user");
        $products = array();
        $catalog = CatalogModel::all();
        foreach ($catalog as $key => $item) {
            $x = ProductsModel::where("catalog_id", $item->id)
            // ->limit(2)
            ->get();
            foreach ($x as $value) {
                array_push($products, $value);
            }
        }
        foreach ($products as $item) {
            $item->photo = json_decode($item->photo);
            $item->glav_photo = $item->photo[0];
        }
        // $array = array();
        // for ($i = 0; $i < 10; $i++) {
        //     array_push($array, $products[rand(0, count($products) -1)]);
        // };
        for ($i = 0; $i < count($products); $i++) {
            $is_card = CardModel::where("user_id", Session::get("user")->id)
                                    ->where("product_id", $products[$i]->id)
                                    ->get();
            count($is_card) > 0 ? $products[$i]["is_card"] = true : $products[$i]["is_card"] = false;
        }
        $products = $this->check_status($products);
        $arr = array("user"=>$user, "products" => $products);
        return view("profile", $arr);
    }
    function check_status($arr)
    {
        for ($i = 0; $i < count($arr); $i++) {
            $arr[$i]->is_unavailable = count(UnavailableModel::where("product_id", $arr[$i]->id)
                ->get());
        }
        return $arr;
    }
    function seller()
    {
        $user = Session::get("user");
        return view("seller", ["user"=>$user]);
    }
    function logout ()
    {
        session()->forget('some_data');
        session()->flush();
        return redirect("/");
    }
    function blocked()
    {
        $user = Session::get("user");
        $x = BlockModel::select("time", "comment")->where("user_id", $user->id)->first();
        if  ($x->time == null) {
            $x->time = "∞";
        }   else {
            $x->time = date("d/m/Y h:i A T",$x->time);

        }
        $user->blocked = $x;
        return view("blocked", ["user" => $user]);
    }

}

