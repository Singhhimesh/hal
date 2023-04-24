<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('upis')){
        Schema::create('upis', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191)->nullable();
            $table->string('upiid', 191)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upis');
    }
}
