<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'eventId', 'userId'
       ];



    public function event()
    {
        return $this->belongsTo(Event::class, 'eventId', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
