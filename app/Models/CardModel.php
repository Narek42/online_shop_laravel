<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductsModel;


class CardModel extends Model
{
    use HasFactory;
    protected $table = "card";
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(ProductsModel::class, "product_id");
    }
}
