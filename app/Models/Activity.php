<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'organization_id',
        'subject_type',
        'subject_id',
        'type',
        'title',
        'description',
        'scheduled_at',
        'completed_at',
        'metadata',
        'created_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'scheduled_at' => 'datetime',
        'completed_at' => 'datetime',
        'metadata' => 'array',
    ];

    /**
     * Get the organization that owns the activity.
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Get the user who created the activity.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the subject of the activity (polymorphic).
     */
    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * Scope a query to only include activities for a specific subject.
     */
    public function scopeForSubject($query, $subjectType, $subjectId)
    {
        return $query->where('subject_type', $subjectType)
                    ->where('subject_id', $subjectId);
    }

    /**
     * Scope a query to only include activities of a specific type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope a query to only include scheduled activities.
     */
    public function scopeScheduled($query)
    {
        return $query->whereNotNull('scheduled_at');
    }

    /**
     * Scope a query to only include completed activities.
     */
    public function scopeCompleted($query)
    {
        return $query->whereNotNull('completed_at');
    }

    /**
     * Scope a query to only include pending activities.
     */
    public function scopePending($query)
    {
        return $query->whereNull('completed_at');
    }
}
