<?php namespace Ammonkc\BonzaiHelper;

use Ammonkc\BonzaiHelper\BladeExtender;
use Illuminate\Support\ServiceProvider;

class BonzaiHelperServiceProvider extends ServiceProvider {

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
        $this->registerBladeExtender();

        $this->publishes([
            __DIR__.'/../../config/bonzai.php' => config_path('bonzai.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/bonzai.php', 'bonzai'
        );

        $this->registerBonzai();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    public function registerBonzai()
    {
        $this->app->bind('bonzaiHelper', 'Ammonkc\BonzaiHelper\BonzaiHelper');

        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();

            // Bonzai asset helper
            $loader->alias('Bonzai', 'Ammonkc\BonzaiHelper\BonzaiHelperFacade');
        });
    }

    /**
     * Register the blade extender to use new blade sections
     */
    protected function registerBladeExtender() {
        BladeExtender::attach($this->app);
    }
}
