<?php
// app/Models/Application.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'job_listing_id', 'cover_letter', 'status', 'applied_at'
    ];

    protected $casts = [
        'applied_at' => 'datetime',
    ];

    const STATUSES = [
        'submitted',
        'pending',
        'in_review',
        'interviewed',
        'rejected',
        'withdrawn',
        'accepted'
    ];

    protected static function booted()
    {
        static::updated(function ($application) {
            if ($application->wasChanged('status')) {
                ApplicationHistory::create([
                    'application_id' => $application->id,
                    'status' => $application->status,
                    'previous_status' => $application->getOriginal('status'),
                    'changed_at' => now()
                ]);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobListing(): BelongsTo
    {
        return $this->belongsTo(JobListing::class);
    }

    public function history(): HasMany
    {
        return $this->hasMany(ApplicationHistory::class);
    }

    public function interview(): HasOne
    {
        return $this->hasOne(Interview::class);
    }

    public function hasScheduledInterview(): bool
    {
        return $this->interview()->exists();
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeByDateRange($query, Carbon $start, Carbon $end)
    {
        return $query->whereBetween('applied_at', [$start, $end]);
    }

    public function updateStatus(string $newStatus, ?string $remarks = null)
    {
        $oldStatus = $this->status;
        $this->update(['status' => $newStatus]);
        
        ApplicationHistory::recordChange($this, $newStatus, $remarks);
        
        return $this;
    }

    public function withdraw(?string $remarks = 'Application withdrawn by jobfinder')
    {
        return $this->updateStatus('withdrawn', $remarks);
    }
}

