<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean'
        ];
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function pengajuan(){
        return $this->hasMany(Pengajuan::class);
    }

    public function bukutamu(){
        return $this->hasMany(BukuTamu::class);
    }

    public function passphrase(){
        return $this->hasMany(Passphrase::class);
    }

    public function pengaduan(){
        return $this->hasMany(Pengaduan::class);
    }

    public function cpanel(){
        return $this->hasMany(Cpanel::class);
    }

    public function emaildinas(){
        return $this->hasMany(EmailDinas::class);
    }

    public function aplikasi(){
        return $this->hasMany(Aplikasi::class);
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }
}
