<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'domain',
        'subscription_plan',
        'subscription_expires_at',
        'settings',
        'logo_url',
        'address',
        'phone',
        'timezone',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'subscription_expires_at' => 'datetime',
        'settings' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the users that belong to the organization.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the companies that belong to the organization.
     */
    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    /**
     * Get the contacts that belong to the organization.
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * Get the deals that belong to the organization.
     */
    public function deals()
    {
        return $this->hasMany(Deals::class);
    }

    /**
     * Get the activities that belong to the organization.
     */
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * Get the email templates that belong to the organization.
     */
    public function emailTemplates()
    {
        return $this->hasMany(EmailTemplate::class);
    }

    /**
     * Get the user invitations that belong to the organization.
     */
    public function userInvitations()
    {
        return $this->hasMany(UserInvitation::class);
    }
}
