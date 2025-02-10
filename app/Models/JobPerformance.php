<?php
// app/Models/JobPerformance.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobPerformance extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_listing_id', 'views', 'applications', 'hired_count'
    ];

    protected $casts = [
        'views' => 'integer',
        'applications' => 'integer',
        'hired_count' => 'integer'
    ];

    public function jobListing(): BelongsTo
    {
        return $this->belongsTo(JobListing::class);
    }
}

