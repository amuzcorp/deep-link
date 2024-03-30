<?php

namespace AmuzPackages\DeepLink\Traits;

use AmuzPackages\DeepLink\Models\DeepLink;
use Exception;

trait HasDeepLink{
    /**
     * @throws Exception
     */
    public function createDeepLink(string $slug, array $contextData): string
    {
        /** @var DeepLink $deepLink */
        $deepLink = DeepLink::query()->where('slug',$slug)->first();
        if(!$deepLink){
            throw new Exception("Invalid Deeplink Slug.");
        }

        $linkContext = $deepLink->linkContexts()->create([
            'context_data' => $contextData
        ]);
        return $linkContext->getAttribute('short_link_url');
    }
}
