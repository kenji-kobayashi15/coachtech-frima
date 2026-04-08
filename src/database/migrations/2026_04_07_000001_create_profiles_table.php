<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $attribute) {
            $attribute->id();
            $attribute->foreignId('user_id')->constrained()->onDelete('cascade');
            $attribute->string('image_url')->nullable();
            $attribute->string('post_code');
            $attribute->string('address');
            $attribute->string('building')->nullable();
            $attribute->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
