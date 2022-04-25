<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 20)->unique();
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('address');
            $table->string('telephone', 12);
            $table->string('email');
            $table->string('note')->nullable();
            $table->decimal('discount')->default(0);
            $table->decimal('total');
            $table->enum('status', ['new', 'accepted', 'delivering', 'cancel', 'done']);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
