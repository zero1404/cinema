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
            $table->id();
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->boolean('gender')->default(false);
            $table->timestamp('birthday')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('telephone')->unique()->nullable();
            $table->string('email')->unique();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('role', ['admin', 'employee', 'customer'])->default('customer');
            $table->rememberToken();
            $table->timestamps();
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
