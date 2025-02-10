<?php
// app/Models/JobType.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_name', 'description'
    ];

    public function jobListings(): HasMany
    {
        return $this->hasMany(JobListing::class);
    }
}

