<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('box_id')->unsigned()->nullable();
                        
            // Save data even after product

            $table->integer('count')->unsigned();
            $table->integer('count_total')->unsigned();

            $table->string('box_name')->nullable();
            $table->string('product_color')->nullable();
            
            $table->integer('product_id')->nullable();
            $table->integer('product_code')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_category')->nullable();

            $table->float('product_price', 20, 4)->default(0);
            $table->float('product_price_total', 20, 4)->default(0);
            $table->float('product_price_financial', 20, 4)->default(0);
            $table->float('product_price_total_financial', 20, 4)->default(0);
        
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('box_id')->references('id')->on('boxes')->onDelete('cascade');
            
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
        Schema::dropIfExists('items');
    }
}
