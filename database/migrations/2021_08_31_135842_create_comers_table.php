<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comers', function (Blueprint $table) {
            $table->id();
            $table->integer('id_number');
            $table->string('name');
            $table->enum('gender', ['MAN', 'WOMAN', 'OTHER']);
            $table->date('arrival');
            $table->integer('resident_id');
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
        Schema::dropIfExists('comers');
    }
}
