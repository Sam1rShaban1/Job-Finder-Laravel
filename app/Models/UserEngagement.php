<?php
// app/Models/UserEngagement.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserEngagement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'score',
        'engagement_details',
        'engaged_at'
    ];

    protected $casts = [
        'engagement_details' => 'array',
        'engaged_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}