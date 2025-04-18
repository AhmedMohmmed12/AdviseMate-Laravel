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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('Fname');
            $table->string('LName');
            $table->string('phoneNumber')->unique();
            $table->enum('gender' ,['male' , 'female']);
            $table->enum('status' , ['active' , 'inactive']);
            $table->string('email')->unique();
            $table->string('Program');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger("ticket_type_detail_id")->nullable();
            $table->unsignedBigInteger("user_id")->nullable();
            
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('ticket_type_detail_id')->references('id')->on('ticket_type_details'); 
            $table->foreign('user_id')->references('id')->on('users'); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
