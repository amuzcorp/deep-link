<?php
namespace AmuzPackages\DeepLink;

use App\Providers\AbstractPackageProvider;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class DeepLinkServiceProvider extends AbstractPackageProvider
{
    protected string $namespace = "AmuzPackages\DeepLink";

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/config/deep-link.php','deep-link');

         $this->app->booted(function () {
            $this->routes();
         });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/config/deep-link.php' => config_path('deep-link.php')
        ], 'deep-link-config');

        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations')
        ], 'deep-link-migrations');

        $this->loadMigrationsFrom(__DIR__ .'/database/migrations');
        Nova::serving(function (ServingNova $event) {
            Nova::resources($this->resources(__DIR__));
            Nova::dashboards($this->dashboards());
            Nova::tools($this->tools());
            // Nova Mix build 후 추가
            //Nova::script('deep-link', __DIR__.'/dist/js/deep-link.js');
            //Nova::style('deep-link', __DIR__.'/dist/css/deep-link.css');
        });
    }

    protected function routes(): void
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
                ->prefix('api/deep-link')
                ->group(__DIR__.'/routes/api.php');

    }

    /**
     * Here you can register your dashboards
     */
    protected function dashboards(): array
    {
        return [];
    }

    /**
     * Here you can register your tools connected to module
     */
    protected function tools(): array
    {
        return [];
    }
}
