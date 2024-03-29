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
    protected $casts = ['context_data' => 'array'];

    public function deepLink(): BelongsTo
    {
        return $this->belongsTo(DeepLink::class);
    }
    public function linkContextHistories(): HasMany
    {
        return $this->hasMany(LinkContextHistory::class);
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
