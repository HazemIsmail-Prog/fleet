<?php

namespace App\Models;

use App\Enums\ActionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Action extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'type' => ActionType::class
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

}
