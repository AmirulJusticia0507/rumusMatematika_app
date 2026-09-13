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
        'photo',
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
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Get the public URL for the user's photo, or a default avatar.
     */
    public function getPhotoUrlAttribute(): string
    {
        return $this->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->photo)
            ? asset('storage/'.$this->photo)
            : 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&background=6366f1&color=fff';
    }

    public function bookmarks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    public function hasBookmarked(string $title): bool
    {
        return $this->bookmarks()->where('rumus_title', $title)->exists();
    }

    public function quizScores(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuizScore::class);
    }

    public function bestScore(string $materi): ?QuizScore
    {
        return $this->quizScores()->where('materi', $materi)->orderByDesc('score')->first();
    }

    public function flashcardProgress(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FlashcardProgress::class);
    }
}
