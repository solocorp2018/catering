<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lang1_name')->nullable();
            
            $table->unsignedSmallInteger('type_id')->default(0);
            $table->float('price',8,2);
            $table->text('image_path')->nullable();
            
            $table->longText('description')->nullable();
            $table->longText('lang1_description')->nullable();
            $table->unsignedSmallInteger('quantity_type_id');
            $table->unsignedBigInteger('created_by');
            
            $table->boolean('status')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->index(['price','name','quantity_type_id','created_by']);
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
