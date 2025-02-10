<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobListingsSearchableTable extends Migration
{
    public function up()
    {
        Schema::create('job_listings_searchable', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_listing_id')->constrained('job_listings')->onDelete('cascade');
            $table->text('searchable_text'); // Store the combined text (title, description, location)
            $table->timestamps();
        });

        // Add a GIN index to the searchable_text column for full-text search
        DB::statement('
            CREATE INDEX job_listings_searchable_text_index
            ON job_listings_searchable
            USING gin (to_tsvector(\'english\', searchable_text));
        ');
    }

    public function down()
    {
        Schema::dropIfExists('job_listings_searchable');
    }
}

