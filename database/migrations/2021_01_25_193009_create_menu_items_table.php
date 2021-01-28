<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        $this->down();
        Schema::create('menu_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('session_menu_id');            
            $table->unsignedBigInteger('item_id');            
            $table->unsignedSmallInteger('quantity_type_id');            
            $table->string('quantity')->nullable();            

            $table->boolean('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->index(['session_menu_id','item_id','quantity_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
}
