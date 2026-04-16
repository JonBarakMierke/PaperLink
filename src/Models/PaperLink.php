<?php

namespace JonMierke\PaperLink\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

#[ObservedBy(PaperLinkObserver::class)]
class PaperLink extends Model implements Auditable
{
    use AuditingAuditable, LogsActivity, BelongsToCustomer;

    protected $fillable = [
        'campaign_id',
        'slug',
        'destination_url',
        'title',
        'is_active',
    ];


    public function linkables()
    {
        return $this->morphedByMany(
            '*',
            'linkable',
            'linkables'
        );
    }

    public function analytics()
    {
        return $this->hasMany(RequestAnalytics::class, 'paperlink_id');
    }

    public function humanAnalytics()
    {
        return $this->analytics()
            ->where('request_category', 'web');
    }

    /**
     * Activity Log
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['slug', 'destination_url', 'is_active', 'title'])
        ->dontLogIfAttributesChangedOnly(['title'])
        ->useLogName('paper_link')
        ->logOnlyDirty();
    }

    protected static $recordEvents = ['created', 'updated', 'deleted'];
}

