<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUpdateV44KidsMode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( Schema::hasTable('movies') ) {
            Schema::table('movies', function (Blueprint $table) {
                if (!Schema::hasColumn('movies', 'is_kids')){
                    $table->boolean('is_kids')->nullable();
                }
            });
        }
        if ( Schema::hasTable('tv_series') ) {
            Schema::table('tv_series', function (Blueprint $table) {
                if (!Schema::hasColumn('tv_series', 'is_kids')){
                    $table->boolean('is_kids')->nullable();
                }
            });
        }
        if ( Schema::hasTable('user_ratings') ) {
            Schema::table('user_ratings', function (Blueprint $table) {
                if (!Schema::hasColumn('user_ratings', 'review')){
                $table->string('review', 1000)->nullable();
                }
            });
        }
        if ( Schema::hasTable('home_sliders') ) {
            Schema::table('home_sliders', function (Blueprint $table) {
                if (!Schema::hasColumn('home_sliders', 'is_kids')){
                    $table->boolean('is_kids')->nullable();
                }
            });
        }
        if ( Schema::hasTable('movies') ) {
            Schema::table('movies', function (Blueprint $table) {
                if (!Schema::hasColumn('movies', 'country')){
                $table->string('country', 250)->default(0);
                }
            });
        }
        if ( Schema::hasTable('tv_series') ) {
            Schema::table('tv_series', function (Blueprint $table) {
                if (!Schema::hasColumn('tv_series', 'country')){
                $table->string('country', 250)->default(0);
                }
            });
        }
        if ( !Schema::hasTable('producer_settings') ) {
            Schema::create('producer_settings', function (Blueprint $table) {
                $table->id();
                $table->string('currency', 191);
                $table->string('currency_symbol', 50);
                $table->integer('producer_revenue')->nullable();
                $table->integer('admin_revenue')->nullable();
                $table->integer('per_view_revenue')->nullable();
                $table->timestamps();
            });
        }
        if ( Schema::hasTable('movie_comments') ) {
            Schema::table('movie_comments', function (Blueprint $table) {
                if (!Schema::hasColumn('movie_comments', 'audio_id')){
                    $table->integer('audio_id')->nullable();
                }
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
        //
    }
}
