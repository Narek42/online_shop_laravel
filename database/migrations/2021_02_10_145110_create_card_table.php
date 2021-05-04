<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card', function (Blueprint $table) {
            $table->id();
            // $table->timestamps();
            $table->foreignId("product_id")->constrained("products")->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("user_Id")->constrained("users")->onUpdate("cascade")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card');
    }
}


// php artisan migrate  ("create tables")
// php artisan make:migration create_card_table create migrations
