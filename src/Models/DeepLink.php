<?php

namespace AmuzPackages\DeepLink\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property LinkContext[] $LinkContexts
 * @property LinkContextHistory[] $linkContextHistories
 */
class DeepLink extends Model
{
    protected $guarded = [];

    public function linkContexts(): HasMany
    {
        return $this->hasMany(LinkContext::class);
    }

    public function linkContextHistories(): HasManyThrough
    {
        return $this->hasManyThrough(LinkContextHistory::class,LinkContext::class);
    }
}
