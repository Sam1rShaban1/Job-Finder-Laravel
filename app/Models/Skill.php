<?php
// app/Models/Skill.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'proficiency',
        'user_id',
        'category'
    ];

    // Define the allowed proficiency levels
    public const PROFICIENCY_LEVELS = [
        'Junior',
        'Intermediate',
        'Senior'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userSkills()
    {
        return $this->hasMany(UserSkill::class);
    }
}

