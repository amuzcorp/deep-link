<?php

namespace AmuzPackages\DeepLink\Http\Controllers;

use AmuzPackages\DeepLink\Models\LinkContext;
use AmuzPackages\DeepLink\Models\LinkContextHistory;
use AmuzPackages\DeepLink\Traits\HasDeepLink;
use AmuzPackages\DeepLink\Models\DeepLink;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use hisorange\BrowserDetect\Facade as Browser;

class DeepLinkController extends Controller
{
    private $browserDetect;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->browserDetect = app('browser-detect');
            return $next($request);
        });
    }

    public function getContext(Request $request,$shortLink = null): JsonResponse
    {
        if($shortLink != null){
            /** @var LinkContext $linkContext */
            $linkContext = LinkContext::query()
                ->with('deepLink')
                ->where('short_link', $shortLink)
                ->first();

            if($linkContext == null) return response()->json([
                'error' => -1,
                'message' => 'undefined context'
            ],401);

            return response()->json([
                'error' => 0,
                'context' => $linkContext->getAttribute('context_data')
            ]);
        }else{
            /** @var LinkContextHistory $linkContextHistory */
            $linkContextHistory = LinkContextHistory::query()->where([
                'ip_address' => $request->ip(),
                'device_family' => $this->browserDetect->deviceFamily(),
                'device_model' => $this->browserDetect->deviceModel(),
                'device_type' => $this->browserDetect->deviceType(),
                'platform_name' => $this->browserDetect->platformName(),
                'platform_version' => $this->browserDetect->platformVersion(),
                'platform_family' => $this->browserDetect->platformFamily(),
            ])->first();

            if($linkContextHistory == null) return response()->json([
                'error' => -2,
                'message' => 'context histories not found'
            ],406);

            return response()->json([
                'error' => 0,
                'context' => $linkContextHistory->linkContext->getAttribute('context_data')
            ]);
        }
    }

    public function redirect(Request $request, $shortLink): View|RedirectResponse
    {
        /** @var LinkContext $linkContext */
        $linkContext = LinkContext::query()
            ->with('deepLink')
            ->where('short_link', $shortLink)
            ->first();
        if(!$linkContext) return view(config('deep-link.pages.fail','deep-link::fail'));

        $linkContextHistory = $linkContext->linkContextHistories()->create([
            'ip_address' => $request->ip(),

            'browser_family' => $this->browserDetect->browserFamily(),
            'browser_engine' => $this->browserDetect->browserEngine(),
            'browser_name' => $this->browserDetect->browserName(),
            'browser_version' => $this->browserDetect->browserVersion(),
            'device_family' => $this->browserDetect->deviceFamily(),
            'device_model' => $this->browserDetect->deviceModel(),
            'device_type' => $this->browserDetect->deviceType(),
            'platform_name' => $this->browserDetect->platformName(),
            'platform_version' => $this->browserDetect->platformVersion(),
            'platform_family' => $this->browserDetect->platformFamily(),

            'referrer' => $request->header('referer'),
            'user_agent' => $this->browserDetect->userAgent(),
        ]);

        return view(config('deep-link.pages.run','deep-link::run'),compact('linkContextHistory','linkContext'));
//        if($this->browserDetect->deviceType() == "Desktop"){
//            return redirect()->to($linkContext->deepLink->getAttribute('target_url'));
//        }else{
//            return view(config('deep-link.pages.run','deep-link::run'),compact('linkContextHistory','linkContext'));
//        }
    }
}
