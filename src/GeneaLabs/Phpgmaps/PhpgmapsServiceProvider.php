<?php namespace GeneaLabs\Phpgmaps;

use GeneaLabs\Phpgmaps\Facades\PhpgmapsFacade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class PhpgmapsServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Publish the migration
        $timestamp = date('Y_m_d_His', time());
        $this->publishes([
            __DIR__.'/Migrations/create_geocoding_table.php.stub' => database_path('migrations') . '/' . $timestamp . '_create_geocoding_table.php',
        ], 'migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('phpgmaps', function () {
            $phpgmaps = new Phpgmaps();
            $phpgmaps->apiKey = config('services.google.maps.api-key');

            return $phpgmaps;
        });


        AliasLoader::getInstance()->alias('Gmaps', PhpgmapsFacade::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('phpgmaps');
    }
}
