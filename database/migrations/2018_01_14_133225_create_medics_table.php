<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::connection('mysql3')->create('medics', function($table)
{
        $table->increments('id');
        $table->string('name');
        $table->string('quantity');
        $table->string('price');
        $table->string('company');
        $table->string('address');


});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql3')->dropIfExists('medics');
    }
}
