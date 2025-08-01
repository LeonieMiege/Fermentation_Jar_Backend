<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Post;

class User extends Authenticatable {

    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'display_name',
        'username',
        'email',
        'password',
        'bio',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function post() {
        return $this->hasMany(Post::class);
    }
    
    public function getBioOrDefault(): string
    {
        return $this->bio ?: 'What\'s your fermentation style? Edit your profile and tell us in your bio!';
    }
}