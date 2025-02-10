<?php
// app/Models/Interview.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'scheduled_at',
        'interview_type',
        'location',
        'notes'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime'
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}

