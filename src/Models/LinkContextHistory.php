<?php

namespace AmuzPackages\DeepLink\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property LinkContext $linkContext
 */
class LinkContextHistory extends Model
{
    protected $guarded = [];
    public function linkContext(): BelongsTo
    {
        return $this->belongsTo(LinkContext::class);
    }
}
