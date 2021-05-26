<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("first_name");
            $table->string("last_name");
            $table->binary("avatar");
            $table->binary("background");
            $table->boolean("is_superuser")->default(false);
            $table->boolean("staff")->default(false);
        });

        Schema::table("accounts", function (Blueprint $table) {
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
        Schema::dropIfExists('accounts');
    }
}
