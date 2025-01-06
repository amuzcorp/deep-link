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
        // return route('deep-link.short-link',['shortLink' => $this->attributes['short_link']]);

        return app('url')->route('deep-link.short-link',['shortLink' => $this->attributes['short_link']], true, env('APP_URL'));
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
