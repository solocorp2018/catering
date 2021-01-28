<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuantityTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('quantity_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('short_code');
            $table->boolean('status');
            $table->softDeletes();
            $table->timestamps();
        });

        Artisan::call('db:seed', array('--class' => 'QuantityTypeTableSeeder'));        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quantity_types');
    }
}
