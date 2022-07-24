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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('role');
            $table->string('firstname');
            $table->string('lastname');
            $table->unsignedBigInteger('nt_id');
            $table->foreign('nt_id')->references('id')->on('base_name_titles')->onUpdate('cascade')->onDelete('cascade');
            $table->string('phone')->unique()->nullable();
            $table->tinyInteger('status')->default('1');
            $table->string('password');
            
                       
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
