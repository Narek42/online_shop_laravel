<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ProductsModel;


class UnavailableModel extends Model
{
    use HasFactory;

    protected $table = "unavailables";
    public $timestamps = false;


}
