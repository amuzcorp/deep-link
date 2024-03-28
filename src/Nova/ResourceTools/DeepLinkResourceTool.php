<?php

namespace AmuzPackages\DeepLink\Nova\ResourceTools;
use AmuzPackages\DeepLink\Nova\Resources\DeepLink;
use Illuminate\Http\Request;
use Laravel\Nova\Exceptions\NovaException;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Tool;


class DeepLinkResourceTool extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * @throws NovaException
     */
    public function menu(Request $request)
    {
        return MenuSection::make('딥링크',[
            MenuItem::resource(DeepLink::class),
        ])->icon('link')->collapsable();
    }
}
