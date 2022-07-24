<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_company', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_th');
            $table->string('phone');
            $table->string('email');
            //address
            $table->string('no')->nullable();
            $table->string('mu')->nullable();
            $table->string('street')->nullable();
            $table->string('province')->nullable();
            $table->string('amphure')->nullable();
            $table->string('district')->nullable();
            $table->string('postcode')->nullable();
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
        Schema::dropIfExists('base_company');
    }
};
