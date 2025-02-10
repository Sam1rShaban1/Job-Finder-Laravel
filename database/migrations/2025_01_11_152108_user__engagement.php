<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user_engagements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('score')->default(0);
            $table->json('engagement_details')->nullable(); // Store additional data in JSON format
            $table->timestamps();
        });
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('user_engagements');
    }
    
};
