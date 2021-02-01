<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('session_menu_id');
            $table->unsignedBigInteger('customer_id');
            $table->dateTime('order_date');
            $table->float('total_amount',8,2);
            $table->unsignedTinyInteger('order_status');            

            $table->unsignedBigInteger('confirmed_by')->nullable();
            $table->unsignedBigInteger('order_processed_by')->nullable();
            $table->unsignedBigInteger('delivered_by')->nullable();

            $table->boolean('status')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->index(['session_menu_id','customer_id']);
            $table->index(['order_status','confirmed_by']);
            $table->index(['order_processed_by','delivered_by']);
            
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
