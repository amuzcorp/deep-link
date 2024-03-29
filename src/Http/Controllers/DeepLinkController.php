<?php

namespace AmuzPackages\DeepLink\Http\Controllers;

use AmuzPackages\DeepLink\Models\LinkContextHistory;
use AmuzPackages\DeepLink\Traits\HasDeepLink;
use AmuzPackages\DeepLink\Models\DeepLink;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use hisorange\BrowserDetect\Parser as Browser;

class DeepLinkController extends Controller
{
    use HasDeepLink;
    public function store(Request $request): JsonResponse
    {
        $deepLinkUrl = $this->createDeepLink($request->get('target_url'),$request->get('context_data',[]));
        return response()->json(['deep_link' => $deepLinkUrl]);
    }

    public function redirect(Request $request, $slug)
    {
        $deepLink = DeepLink::query()->where('slug', $slug)->firstOrFail();


        $ipAddress = $request->ip();
        $userAgent = $request->header('User-Agent');
        $os = Browser::platformName();
        $browser = Browser::browserName();
        $deviceType = Browser::deviceType();
        $accessedAt = now();

        // 기록 저장
        LinkContextHistory::create([
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'os' => $os,
            'browser' => $browser,
            'device_type' => $deviceType,
            'accessed_at' => $accessedAt,
            'deep_link_id' => DeepLink::where('slug', $slug)->firstOrFail()->id,
        ]);

        // Android 기기인 경우
        if ($agent->isAndroidOS()) {
            if ($deepLink->aos_package && $request->has('installed') && $request->installed == 'true') {
                return redirect()->away('intent://' . $deepLink->aos_package . '#Intent;scheme=yourapp;package=' . $deepLink->aos_package . ';end');
            } else {
                return redirect()->away($deepLink->aos_install_url);
            }
        }

        // iOS 기기인 경우
        if ($agent->isiOS()) {
            if ($deepLink->ios_bundle && $request->has('installed') && $request->installed == 'true') {
                return redirect()->away('yourapp://' . $deepLink->ios_bundle);
            } else {
                return redirect()->away($deepLink->ios_install_url);
            }
        }

        return redirect()->away($deepLink->target_url);
    }
}
