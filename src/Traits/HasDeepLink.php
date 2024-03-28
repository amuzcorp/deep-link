<?php

namespace AmuzPackages\DeepLink\Traits;

use AmuzPackages\DeepLink\Models\DeepLink;

trait HasDeepLink{
    public function createDeepLink(string $targetUrl,array $contextData): string
    {
        $deepLink = DeepLink::query()->create([
            'target_url' => $targetUrl,
            'context_data' => $contextData,
        ]);

        return route('deep-link.get',['slug' => $deepLink->getAttribute('slug')]);
    }
}
