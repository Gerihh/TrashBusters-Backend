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
           return $this->belongsTo(Event::class, 'eventId'); // Adjust the foreign key if needed
       }
}
