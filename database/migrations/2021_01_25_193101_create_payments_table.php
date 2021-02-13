<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payment_unique_id');
            $table->unsignedBigInteger('order_id');
            $table->float('amount',8,2);
            $table->string('transaction_id')->nullable();
            $table->text('comments')->nullable();
            $table->unsignedSmallInteger('payment_mode');
            $table->unsignedBigInteger('recieved_by')->default(0);
            $table->dateTime('payment_date');
            $table->unsignedBigInteger('paid_by');
            $table->unsignedSmallInteger('payment_status');

            $table->softDeletes();
            $table->timestamps();
            $table->index(['order_id','payment_mode']);
            $table->index(['recieved_by','paid_by','payment_status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
