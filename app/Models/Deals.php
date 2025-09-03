<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deals extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'organization_id',
        'contact_id',
        'company_id',
        'title',
        'description',
        'value',
        'currency',
        'stage',
        'probability',
        'expected_close_date',
        'actual_close_date',
        'lost_reason',
        'created_by',
        'assigned_to',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'value' => 'decimal:2',
        'expected_close_date' => 'date',
        'actual_close_date' => 'date',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the organization that owns the deal.
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Get the contact that the deal belongs to.
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    /**
     * Get the company that the deal belongs to.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the user who created the deal.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user assigned to the deal.
     */
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get the activities related to this deal.
     */
    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}
