<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JwtToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_id', 'user_id', 'token_title', 'restrictions', 'permissions', 'expires_at', 'last_used_at', 'refreshed_at'
    ];

    protected $casts = [
        'restrictions' => 'array',
        'permissions' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}