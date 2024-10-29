<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'due_date', 'status', 'user_id'];

    protected $casts = [
        'due_date' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * @param $value
     * @return string
     */
    public function getDueDateAttribute($value): string
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * @param $value
     * @return Carbon
     */
    public function setDueDateAttribute($value): Carbon
    {
        return $this->attributes['due_date'] = Carbon::parse($value);
    }
}
