<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPerformancesTable extends Migration
{
    public function up()
    {
        Schema::create('job_performances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_listing_id')->constrained()->onDelete('cascade');
            $table->integer('views')->default(0);
            $table->integer('applications')->default(0);
            $table->integer('hired_count')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_performances');
    }
} 