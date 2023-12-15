<?php

namespace App\Models;

use App\Models\Fashion;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RentLogs extends Model
{
    use HasFactory;

    protected $table = 'rent_logs';

    protected $fillable = [
        'user_id', 'fashion_id', 'rent_date', 'return_date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function fashion(): BelongsTo
    {
        return $this->belongsTo(Fashion::class, 'fashion_id', 'id');
    }
}
