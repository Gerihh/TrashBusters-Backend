<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use HasFactory, Notifiable, HasApiTokens;

   public $timestamps = false;

   protected $fillable = [
    'username','email', 'city', 'password', 'profilePictureURL', 'verificationToken', 'isVerified', 'passwordResetToken',
   ];
}
