<?php
// app/Models/ApplicationHistory.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id', 
        'status', 
        'remarks',
        'changed_at',
        'previous_status'
    ];

    protected $casts = [
        'changed_at' => 'datetime'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public static function recordChange(Application $application, string $newStatus, ?string $remarks = null)
    {
        return self::create([
            'application_id' => $application->id,
            'status' => $newStatus,
            'previous_status' => $application->status,
            'remarks' => $remarks,
            'changed_at' => now()
        ]);
    }
}


