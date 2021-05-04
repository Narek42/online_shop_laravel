<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductsModel;

class UsersModel extends Model
{
    use HasFactory;
    protected $table = "users";
    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(ProductsModel::class, "user_id", "id");
    }
}
