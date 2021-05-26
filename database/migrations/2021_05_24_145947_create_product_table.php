<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name");
            $table->binary("image");
            $table->decimal("price", 8, 2);
            $table->tinyInteger("stock");
            $table->boolean("sold")->default(false);
        });

        Schema::table("product", function (Blueprint $table) {
            $table->foreignId("category_id")->constrained("category")->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId("user_id")->constrained("users")->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
