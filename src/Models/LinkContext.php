<?php

namespace AmuzPackages\DeepLink\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @property DeepLink $deepLink
 * @property LinkContextHistory[] $linkContextHistories
 */
class LinkContext extends Model
{
    protected $guarded = [];
    protected $casts = [
        'context_data' => 'array'
    ];
    protected $appends = [
        'short_link_url'
    ];

    public function deepLink(): BelongsTo
    {
        return $this->belongsTo(DeepLink::class);
    }
    public function linkContextHistories(): HasMany
    {
        return $this->hasMany(LinkContextHistory::class);
    }

    public function getShortLinkUrlAttribute(): string
    {
        $previousScheme = \Illuminate\Support\Facades\URL::formatScheme();
        \Illuminate\Support\Facades\URL::forceScheme('https');

        $url = route('deep-link.short-link', ['shortLink' => $this->attributes['short_link']]);

        if ($previousScheme) {
            \Illuminate\Support\Facades\URL::forceScheme($previousScheme);
        }

        return $url;
    }

    protected static function boot(): void
    {
        parent::boot();
        self::creating(function(LinkContext $linkContext){
            $isUnique = false;
            $shortLink = '';
            while(!$isUnique){
                $shortLink = Str::random(10);
                $isUnique = !LinkContext::query()->where('short_link', $shortLink)->exists();
            }
            $linkContext->setAttribute('short_link',$shortLink);
        });
    }
}
