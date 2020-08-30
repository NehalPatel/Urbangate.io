<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('com_members', function (Blueprint $table) {
            $table->id('auto_id');
            $table->string('member_id', 50)->unique();
            $table->string('member_no', 50)->unique();

            $table->string('user_id', 50);
            $table->foreign('user_id')->references('user_id')->on('users');

            $table->string('society_id', 50);
            $table->foreign('society_id')->references('society_id')->on('soc_societies');

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
        Schema::dropIfExists('com_members');
    }
}
