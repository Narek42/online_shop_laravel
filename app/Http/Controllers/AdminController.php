<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\UsersModel;
use App\Models\BlockModel;




class AdminController extends Controller
{
    function admin()
    {
        $admin = Session::get("user");
        return view("admin", ["admin"=>$admin]);
    }
    function get_users()
    {
        $users = UsersModel::select("id", "name", "surname", "email", "input", "type")->where("type", "!=", "2")->get();
        for ($i=0; $i < count($users); $i++) {
            $users[$i]->block = BlockModel::where("user_id", $users[$i]->id)->count();
            if  ($users[$i]->block > 0) {
                $users[$i]->unlocked = abs(getdate()["0"] - BlockModel::select("time")->where("user_id", $users[$i]->id)->first()->time);
            }
        }
        return json_encode($users);
    }
    function admin_logout()
    {
        session()->forget('some_data');
        session()->flush();
        return redirect("/");
    }
    function block_user(Request $req)
    {
        $obj = new BlockModel();
        $obj->user_id = $req->id;
        $obj->admin_id = Session::get("user")->id;
        $obj->comment = $req->comment;
        $time_now = getdate()["0"];
        if ($req->time == 7) {
            $time_now += 60 * 60 * 24 * $req->time;
            $obj->time = $time_now;
        }   else if ($req->time == 14) {
            $time_now += 60 * 60 * 24 * $req->time;
            $obj->time = $time_now;
        } else {
            $obj->time = null;
        }
        $obj->save();
        return json_encode(1);
    }
    function unblock_user(Request $req) {
        BlockModel::where("user_id", $req->id)->delete();
        return json_encode(1);
    }
}
