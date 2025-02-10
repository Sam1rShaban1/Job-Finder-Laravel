<?php
// app/Models/JobListing.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;

class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'employer_id',
        'type',
        'requirements',
        'closing_date',
        'salary_range',
        'location',
        'experience_level'
    ];

    protected $casts = [
        'requirements' => 'array',
        'closing_date' => 'date',
        'salary_range' => 'array'
    ];

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(JobListingCategory::class);
    }

    public function performance(): HasOne
    {
        return $this->hasOne(JobPerformance::class);
    }

    public function scopeActive($query)
    {
        return $query->where('closing_date', '>', now());
    }

    public function scopeSearch($query, string $term)
    {
        return $query->where('title', 'like', "%{$term}%")
                    ->orWhere('description', 'like', "%{$term}%");
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeBySalaryRange($query, int $min, int $max = null)
    {
        if ($max) {
            return $query->whereJsonContains('salary_range->min', '>=', $min)
                        ->whereJsonContains('salary_range->max', '<=', $max);
        }
        return $query->whereJsonContains('salary_range->min', '>=', $min);
    }

    public function scopeByExperienceLevel($query, string $level)
    {
        return $query->where('experience_level', $level);
    }
}

