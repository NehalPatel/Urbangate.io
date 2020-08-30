<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id('auto_id');
            $table->string('user_id', 50)->unique();
            $table->string('user_no', 50)->unique();

            $table->string('first_name', 100)->default(null)->nullable();
            $table->string('last_name', 100)->default(null)->nullable();
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->default(null)->nullable();
            $table->rememberToken();
            $table->string('mobile',20)->nullable();
            $table->string('type',50)->default('user'); //userType
            $table->string('photo_id', 50)->default(null)->nullable();

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
        Schema::dropIfExists('users');
    }
}
