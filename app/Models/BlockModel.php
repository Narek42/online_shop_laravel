<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockModel extends Model
{
    use HasFactory;
    protected $table = "block";
    public $timestamps = false;
}
