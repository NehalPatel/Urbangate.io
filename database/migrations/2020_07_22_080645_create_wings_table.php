<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soc_wings', function (Blueprint $table) {
            $table->id('auto_id');
            $table->string('wing_id', 50)->unique();
            $table->string('wing_no', 50)->unique();

            $table->string('society_id', 50);
            $table->foreign('society_id')->references('society_id')->on('soc_societies')->onDelete('cascade');

            $table->string('name', 100);
            $table->string('type', 50)->nullable()->default(null);
            $table->integer('number_of_floors')->default(0);
            $table->integer('number_of_flats')->default(0);

            $table->string('wing_president_id', 50)->nullable()->default(null);
            $table->foreign('wing_president_id')->references('member_id')->on('com_members');

            $table->string('wing_treasurer_id', 50)->nullable()->default(null);
            $table->foreign('wing_treasurer_id')->references('member_id')->on('com_members');

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
        Schema::dropIfExists('soc_wings');
    }
}
