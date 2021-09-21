<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('id_number');
            $table->string('email');
            $table->enum('gender', ['MAN', 'WOMAN', 'OTHER']);
            $table->string('place_of_birth');
            $table->date('born_date');
            $table->enum('religion', ['ISLAM', 'KATOLIK', 'HINDU', 'BUDDHA', 'KRISTEN', 'KHONGHUCU', 'ATHEIS']);
            $table->string('education');
            $table->string('type_of_work');
            $table->enum('marital_status', ['MARRIED', 'WIDOWED', 'SEPARATED', 'DIVORCED', 'SINGLE']);
            $table->longText('address');
            $table->integer('rt');
            $table->integer('rw');
            $table->string('village');
            $table->bigInteger('contact');
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
        Schema::dropIfExists('residents');
    }
}
