<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyAccessRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soc_property_access_request', function (Blueprint $table) {
            $table->id('auto_id');
            $table->string('property_access_request_id', 50)->unique();
            $table->string('property_access_request_no', 50)->unique();

            $table->string('user_id', 50);
            $table->foreign('user_id')->references('user_id')->on('users');

            $table->string('society_id', 50);
            $table->foreign('society_id')->references('society_id')->on('soc_societies');

            $table->string('wing_id', 50);
            $table->foreign('wing_id')->references('wing_id')->on('soc_wings');

            $table->string('property_id', 50);
            $table->foreign('property_id')->references('property_id')->on('soc_properties');

            $table->string('request_type', 50)->nullable()->default(null); //as owner,tenant
            $table->integer('status', false, 40);

            $table->timestamp('requested_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('requested_device_name', 50)->nullable()->default(null);
            $table->string('requested_device_ip', 50)->nullable()->default(null);

            $table->timestamp('authorized_at')->nullable()->default(null);
            $table->string('authorized_by_id', 50)->nullable()->default(null);
            $table->foreign('authorized_by_id')->references('user_id')->on('users');

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
        Schema::dropIfExists('soc_property_access_request');
    }
}
