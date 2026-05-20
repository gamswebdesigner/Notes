<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Override;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public $salt = 123456789;

    public function getRouteKey(): string
    {
        $hashId = $this->getKey() * $this->salt;
        return rtrim(strtr(base64_encode($hashId), '+/', '-_'), '=');
    }

    #[Override]
    public function resolveRouteBinding($value, $field = null)
    {
        $padded = str_pad(strtr($value, '-_', '+/'), strlen($value) % 4, '=', STR_PAD_RIGHT);
        $decoded = base64_decode($padded);
        if ($decoded !== false && is_numeric($decoded)) {
            $id = (int)$decoded / $this->salt;
            return $this->where($field ?? $this->getKeyName(), $id)->firstOrFail();
        }
        abort(404);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        ];
    }
}
