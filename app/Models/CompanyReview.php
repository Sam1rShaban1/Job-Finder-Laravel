<?php
// app/Models/CompanyReview.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'user_id',
        'rating',
        'title',
        'content',
        'review_text'
    ];

    protected $casts = [
        'rating' => 'integer'
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

