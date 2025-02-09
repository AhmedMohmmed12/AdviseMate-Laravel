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
        Schema::create('ticket_type_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ticket_type_id");
            $table->unsignedBigInteger("student_id");
            $table->unsignedBigInteger("user_id");
            $table->enum("ticket_status" , ["pending" , "completed" , "rejected"]); 
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students'); 
            $table->foreign('user_id')->references('id')->on('users'); 

            $table->foreign('ticket_type_id')->references('id')->on('ticket_type'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_type_details');
    }
};
