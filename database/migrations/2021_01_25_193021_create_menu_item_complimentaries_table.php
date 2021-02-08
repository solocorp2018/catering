<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemComplimentariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('menu_item_complimentaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('session_menu_id');
            $table->unsignedBigInteger('menu_item_id');
            $table->unsignedBigInteger('complimentary_id');
            $table->unsignedSmallInteger('quantity_type_id');
            $table->string('quantity');

            $table->boolean('status')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->index(['session_menu_id','menu_item_id']);
            $table->index(['quantity_type_id']);
            $table->index(['complimentary_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_item_complimentaries');
    }
}
