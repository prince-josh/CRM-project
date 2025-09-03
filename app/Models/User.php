<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'organization_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'is_active',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the organization that owns the user.
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Get the companies created by this user.
     */
    public function createdCompanies()
    {
        return $this->hasMany(Company::class, 'created_by');
    }

    /**
     * Get the contacts created by this user.
     */
    public function createdContacts()
    {
        return $this->hasMany(Contact::class, 'created_by');
    }

    /**
     * Get the contacts assigned to this user.
     */
    public function assignedContacts()
    {
        return $this->hasMany(Contact::class, 'assigned_to');
    }

    /**
     * Get the deals created by this user.
     */
    public function createdDeals()
    {
        return $this->hasMany(Deals::class, 'created_by');
    }

    /**
     * Get the deals assigned to this user.
     */
    public function assignedDeals()
    {
        return $this->hasMany(Deals::class, 'assigned_to');
    }

    /**
     * Get the activities created by this user.
     */
    public function createdActivities()
    {
        return $this->hasMany(Activity::class, 'created_by');
    }

    /**
     * Get the email templates created by this user.
     */
    public function createdEmailTemplates()
    {
        return $this->hasMany(EmailTemplate::class, 'created_by');
    }

    /**
     * Get the invitations sent by this user.
     */
    public function sentInvitations()
    {
        return $this->hasMany(UserInvitation::class, 'invited_by');
    }
}
