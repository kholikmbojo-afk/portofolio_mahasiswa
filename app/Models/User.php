<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'role', 'nim', 'prodi', 'password', 'phone', 'avatar_url', 'bio', 'angkatan', 'linkedin_url', 'github_url'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'role',
        'nim',
        'prodi',
        'password',
        'avatar_url',
        'bio',
        'phone',
        'linkedin_url',
        'github_url',
        'angkatan',
    ];

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
        ];
    }

    public function isAdmin(): bool
    {
        return in_array(strtolower($this->role ?? ''), ['admin', 'administrator', 'kurator']);
    }

    public function isMahasiswa(): bool
    {
        return in_array(strtolower($this->role ?? ''), ['mahasiswa', 'creator', 'kreator', 'student']);
    }

    public function projects()
    {
        return $this->hasMany(\App\Models\Project::class);
    }

    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class)->latest();
    }
}
