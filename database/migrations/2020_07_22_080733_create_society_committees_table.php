<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocietyCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('com_society_committees', function (Blueprint $table) {
            $table->id('auto_id');
            $table->string('society_committee_id', 50)->unique();
            $table->string('society_committee_no', 50)->unique();

            $table->string('society_id', 50);
            $table->foreign('society_id')->references('society_id')->on('soc_societies');

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
        Schema::dropIfExists('com_society_committees');
    }
}
