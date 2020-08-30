<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soc_property_access', function (Blueprint $table) {
            $table->id('auto_id');
            $table->string('request_permission_id', 50)->unique();
            $table->string('request_permission_no', 50)->unique();

            $table->string('user_id', 50);
            $table->foreign('user_id')->references('user_id')->on('users');

            $table->string('property_id', 50);
            $table->foreign('property_id')->references('property_id')->on('soc_properties');
            $table->string('access_type', 50)->nullable()->default(null); //as owner,tenant

            $table->timestamps();
            $table->softDeletes();
            $table->string('deleted_by', 50)->default(null)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soc_property_access');
    }
}
