<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UsersModel;
use App\Models\FeedbackModel;
use App\Models\UnavailableModel;

class ProductsModel extends Model
{
    use HasFactory;
    protected $table = "products";
    public $timestamps = false;

    public function seller()
    {
        return $this->belongsTo(UsersModel::class, "user_id");
    }
}
