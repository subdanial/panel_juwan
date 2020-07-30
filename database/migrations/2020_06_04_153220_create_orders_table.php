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
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            $table->integer('status')->default(0);
            $table->integer('type')->default(0);
            $table->integer('returned')->default(0);

            $table->float('amount', 16, 4)->nullable();
            $table->float('amount_financial', 16, 4)->nullable();
            $table->float('amount_returned', 16, 4)->nullable();
            $table->float('discount', 16, 4)->default(0)->nullable();

            $table->float('pos', 16, 4)->nullable();
            $table->float('cheque', 16, 4)->nullable();
            $table->float('cash', 16, 4)->nullable();
            
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('submit_slug')->nullable();
            
            $table->integer('maali_status')->default(0);
            $table->integer('anbaar_status')->default(0);
            $table->integer('foroosh_status')->default(0);
            
            $table->string('date_manual')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('clients');
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
