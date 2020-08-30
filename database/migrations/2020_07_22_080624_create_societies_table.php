<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soc_societies', function (Blueprint $table) {
            $table->id('auto_id');
            $table->string('society_id', 50)->unique();
            $table->string('society_no', 50)->unique();

            $table->string('name', 100);
            $table->string('full_name', 100)->nullable()->default(null);
            $table->string('registration_number', 50)->nullable()->default(null);
            $table->string('address_line_1', 255)->nullable()->default(null);
            $table->string('address_line_2', 255)->nullable()->default(null);
            $table->string('area', 50)->nullable()->default(null);
            $table->string('city', 50)->nullable()->default(null);
            $table->string('state', 50)->nullable()->default(null);
            $table->string('country', 50)->nullable()->default(null);
            $table->string('pincode', 50)->nullable()->default(null);

            $table->string('email', 50)->nullable()->default(null);
            $table->string('website', 50)->nullable()->default(null);
            $table->string('phone', 20)->nullable()->default(null);

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
        Schema::dropIfExists('soc_societies');
    }
}
