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
        Schema::create('saved_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_listing_id')->constrained()->onDelete('cascade');
            $table->timestamp('saved_at')->useCurrent();
            $table->timestamps();
            
            // Add unique constraint to prevent duplicate saves
            $table->unique(['user_id', 'job_listing_id']);
        });
    }
    
    
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('saved_jobs');
    }
    
};
