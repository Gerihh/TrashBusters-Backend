<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assigned extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'eventId', 'dumpId'
    ];

    /**
     * Get the event that owns the Assigned
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'eventId', 'id');
    }

    public function dump(): BelongsTo
    {
        return $this->belongsTo(Dump::class, 'dumpId', 'id');
    }
}
