<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soc_properties', function (Blueprint $table) {
            $table->id('auto_id');
            $table->string('property_id', 50)->unique();
            $table->string('property_no', 50)->unique();

            $table->string('society_id', 50);
            $table->foreign('society_id')->references('society_id')->on('soc_societies');

            $table->string('wing_id', 50);
            $table->foreign('wing_id')->references('wing_id')->on('soc_wings');

            $table->integer('property_number')->default(0);
            $table->integer('floor_number')->default(0);
            $table->string('type', 50)->nullable()->default(null);
            $table->string('property_location', 50)->nullable()->default(null);
            $table->integer('property_size_sqft')->default(0);

            $table->string('primary_owner_id', 50)->nullable()->default(null);
            $table->foreign('primary_owner_id')->references('member_id')->on('com_members');
            $table->string('secondary_owner_id', 50)->nullable()->default(null);
            $table->foreign('secondary_owner_id')->references('member_id')->on('com_members');

            $table->integer('status', false, 10);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('created_by', 50)->default(null)->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->string('updated_by', 50)->default(null)->nullable();
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
        Schema::dropIfExists('soc_properties');
    }
}
