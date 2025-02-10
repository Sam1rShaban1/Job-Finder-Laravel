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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('employer_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['full-time', 'part-time', 'contract', 'internship'])->default('full-time');
            $table->json('requirements')->nullable(); // Store requirements as JSON
            $table->date('closing_date')->nullable();
            $table->string('location')->nullable();
            $table->string('salary_range')->nullable();
            $table->string('experience_level')->nullable();
            $table->timestamps();
        });
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('job_listings');
    }
    
};
