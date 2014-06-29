<?php namespace Appitventures\Phpgmaps;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class PhpgmapsServiceProvider extends ServiceProvider {

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
		$this->package('appitventures/phpgmaps');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->booting(function()
        {
            $loader = AliasLoader::getInstance();
            $loader->alias('Gmaps', 'Appitventures\Phpgmaps\Facades\Phpgmaps');
        });
		$this->app['phpgmaps'] = $this->app->share(function($app){
            return new Phpgmaps();
        });
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
