<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;
use App\Models\CardModel;
use App\Models\ProductsModel;
use App\Models\BayProductsModel;
use App\Models\UnavailableModel;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        $total = 0;
        $products = CardModel::where("user_id", Session::get("user")->id)
                    ->get();
        $products = $this->chack_status_without_product_id($products);
        for ($i=0; $i < count($products); $i++) {
            if ($products[$i]->is_unavailable == 0) {
                $total += $products[$i]->product->price;
            }
        }
        return view('stripe', ["total"=>$total]);
    }

    function chack_status_without_product_id($arr)
    {
        for ($i = 0; $i < count($arr); $i++) {
            $arr[$i]->is_unavailable = count(UnavailableModel::where("product_id", $arr[$i]->product_id)
                ->get());
        }
        return $arr;
    }
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);

        Session::flash('success', 'Payment successful!');
        $this->save_bay_products();
        return back();
    }
    function save_bay_products()
    {
        $products = CardModel::select("id", "product_id")->where("user_id", Session::get("user")->id)->get();
        foreach ($products as $item) {
            $bay = new BayProductsModel();
            $bay->user_id = Session::get("user")->id;
            $bay->product_id = $item->product_id;
            $bay->save();
            CardModel::where("user_id", Session::get("user")->id)
                ->where("product_id", $item->product_id)
                ->delete();
        }
    }
}
