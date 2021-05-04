<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BayProductsModel extends Model
{
    use HasFactory;
    protected $table = "bay_products";
    public $timestamps = false;
}
