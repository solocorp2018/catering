<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('session_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedSmallInteger('session_type_id');            
            $table->dateTime('session_date');            
            $table->time('opening_time');            
            $table->time('closing_time');            
            $table->time('expected_delivery_time')->nullable();            

            $table->unsignedBigInteger('created_by');            
            $table->boolean('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->index(['session_type_id','session_date']);
            $table->index(['opening_time','closing_time','created_by']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session_menus');
    }
}
