<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplimentariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('complimentaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lang1_name');
            $table->text('image_path')->nullable();
            $table->longText('description')->nullable();
            $table->longText('lang1_description')->nullable();
            $table->unsignedSmallInteger('quantity_type_id');
            
            $table->unsignedBigInteger('created_by');            
            $table->boolean('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->index(['name','quantity_type_id','created_by']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complimentaries');
    }
}
