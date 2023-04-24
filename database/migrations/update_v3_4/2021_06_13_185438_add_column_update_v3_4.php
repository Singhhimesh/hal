<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AddColumnUpdateV34 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if ( Schema::hasTable('configs') ) {
            Schema::table('configs', function (Blueprint $table) {
                if (!Schema::hasColumn('configs', 'aws')){
                    $table->boolean('aws')->default(0);
                }
                if (!Schema::hasColumn('configs', 'omise_payment')){
                    $table->boolean('omise_payment')->default(0);
                }
                 if (!Schema::hasColumn('configs', 'flutterrave_payment')){
                    $table->boolean('flutterrave_payment')->default(0);
                }
                if (!Schema::hasColumn('configs', 'instamojo_payment')){
                    $table->boolean('instamojo_payment')->default(0);
                }
                
            });
        }
        if ( Schema::hasTable('buttons') ) {
            Schema::table('buttons', function (Blueprint $table) {
                if (!Schema::hasColumn('buttons', 'two_factor')){
                    $table->boolean('two_factor')->default(0);
                }
                if (!Schema::hasColumn('buttons', 'countviews')){
                    $table->boolean('countviews')->default(0);
                }
            });
        }
         if ( Schema::hasTable('audio_languages') ) {
            Schema::table('audio_languages', function (Blueprint $table) {
                if (!Schema::hasColumn('audio_languages', 'image')){
                    $table->string('image')->nullable();
                }
                if (!Schema::hasColumn('audio_languages', 'status')){
                    $table->boolean('status')->default(0);
                }
                
            });
        }
         if ( Schema::hasTable('videolinks') ) {
            Schema::table('videolinks', function (Blueprint $table) {
                if (!Schema::hasColumn('videolinks', 'upload_video')){
                    $table->longtext('upload_video')->nullable();
                }
            });
        }
       
         if ( Schema::hasTable('users') ) {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'google2fa_secret')){
                    $table->string('google2fa_secret',191)->nullable();
                }
                if (!Schema::hasColumn('users', 'google2fa_enable')){
                    $table->boolean('google2fa_enable')->default(0);
                }
            });
        }
         if ( Schema::hasTable('packages') ) {
            Schema::table('packages', function (Blueprint $table) {
                if (!Schema::hasColumn('packages', 'free')){
                    $table->boolean('free')->default(0);
                }
                if (Schema::hasColumn('packages', 'amount')){
                    $table->decimal('amount', 8, 2)->default(0)->change();
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
       if(Schema::hasTable('configs')){
            Schema::table('configs', function (Blueprint $table) {
                $table->dropColumn('aws');
                $table->dropColumn('omise_payment');
                $table->dropColumn('flutterrave_payment');
                $table->dropColumn('instamojo_payment');
            });
        }
        if(Schema::hasTable('audio_languages')){
            Schema::table('audio_languages', function (Blueprint $table) {
                $table->dropColumn('image');
                $table->dropColumn('status');
               
            });
        }
         if(Schema::hasTable('buttons')){
            Schema::table('buttons', function (Blueprint $table) {
                $table->dropColumn('two_factor');
                $table->dropColumn('countviews');
            });
        }

        if(Schema::hasTable('videolinks')){
            Schema::table('videolinks', function (Blueprint $table) {
                $table->dropColumn('upload_video');
            });
        }
         if(Schema::hasTable('packages')){
            Schema::table('packages', function (Blueprint $table) {
                $table->dropColumn('free');
            });
        }
         if(Schema::hasTable('users')){
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('google2fa_secret');
                $table->dropColumn('google2fa_enable');
            });
        }
    }
}
