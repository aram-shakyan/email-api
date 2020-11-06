<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailLog extends Model
{
    use HasFactory;

    // Statuses
    const PROGRESS = 1;
    const UNDELIVERED = 2;
    const DELIVERED = 3;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'status',
        'message',
    ];


    protected $casts = ['status' => 'integer'];


    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }


    /**
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        $statuses = [
            EmailLog::PROGRESS => 'in progress',
            EmailLog::UNDELIVERED => 'undelivered',
            EmailLog::DELIVERED => 'delivered',
        ];

        return $statuses[$this->attributes['status']];
    }
}
