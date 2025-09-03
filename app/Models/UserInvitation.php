<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInvitation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'organization_id',
        'email',
        'role',
        'token',
        'invited_by',
        'expires_at',
        'accepted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expires_at' => 'datetime',
        'accepted_at' => 'datetime',
    ];

    /**
     * Get the organization that the invitation belongs to.
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Get the user who sent the invitation.
     */
    public function inviter()
    {
        return $this->belongsTo(User::class, 'invited_by');
    }

    /**
     * Check if the invitation has expired.
     */
    public function isExpired()
    {
        return $this->expires_at->isPast();
    }

    /**
     * Check if the invitation has been accepted.
     */
    public function isAccepted()
    {
        return !is_null($this->accepted_at);
    }

    /**
     * Check if the invitation is still valid (not expired and not accepted).
     */
    public function isValid()
    {
        return !$this->isExpired() && !$this->isAccepted();
    }

    /**
     * Scope a query to only include valid invitations.
     */
    public function scopeValid($query)
    {
        return $query->where('expires_at', '>', now())
                    ->whereNull('accepted_at');
    }

    /**
     * Scope a query to only include expired invitations.
     */
    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<', now());
    }

    /**
     * Scope a query to only include accepted invitations.
     */
    public function scopeAccepted($query)
    {
        return $query->whereNotNull('accepted_at');
    }
}
