<?php namespace Ammonkc\BonzaiHelper;

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
        // $this->package('ammonkc/bonzai-helper');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBonzai();

        $this->registerBladeExtensions();
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
     * Register the Blade extensions with the compiler.
     *
     * @return void
     */
    protected function registerBladeExtensions()
    {
        $blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();

        $blade->extend(function($value, $compiler)
        {
            $matcher = $compiler->createMatcher('javascript');

            return preg_replace($matcher, '$1<?php echo Bonzai::javascript$2; ?>', $value);
        });

        $blade->extend(function($value, $compiler)
        {
            $matcher = $compiler->createMatcher('jquery');

            return preg_replace($matcher, '$1<?php echo Bonzai::jquery$2; ?>', $value);
        });

        $blade->extend(function($value, $compiler)
        {
            $matcher = $compiler->createMatcher('angular');

            return preg_replace($matcher, '$1<?php echo Bonzai::angular$2; ?>', $value);
        });

        $blade->extend(function($value, $compiler)
        {
            $matcher = $compiler->createMatcher('ckeditor');

            return preg_replace($matcher, '$1<?php echo Bonzai::ckeditor$2; ?>', $value);
        });

        $blade->extend(function($value, $compiler)
        {
            $matcher = $compiler->createMatcher('javascript_secure');

            return preg_replace($matcher, '$1<?php echo Bonzai::javascript_secure$2; ?>', $value);
        });

        $blade->extend(function($value, $compiler)
        {
            $matcher = $compiler->createMatcher('stylesheet');

            return preg_replace($matcher, '$1<?php echo Bonzai::stylesheet$2; ?>', $value);
        });

        $blade->extend(function($value, $compiler)
        {
            $matcher = $compiler->createMatcher('stylesheet_secure');

            return preg_replace($matcher, '$1<?php echo Bonzai::stylesheet_secure$2; ?>', $value);
        });

        $blade->extend(function($value, $compiler)
        {
            $matcher = $compiler->createMatcher('image');

            return preg_replace($matcher, '$1<?php echo Bonzai::image$2; ?>', $value);
        });

        $blade->extend(function($value, $compiler)
        {
            $matcher = $compiler->createMatcher('image_secure');

            return preg_replace($matcher, '$1<?php echo Bonzai::image_secure$2; ?>', $value);
        });

        $blade->extend(function($value, $compiler)
        {
            $matcher = $compiler->createMatcher('icon');

            return preg_replace($matcher, '$1<?php echo Bonzai::icon$2; ?>', $value);
        });

        $blade->extend(function($value, $compiler)
        {
            $matcher = $compiler->createMatcher('icon_secure');

            return preg_replace($matcher, '$1<?php echo Bonzai::icon_secure$2; ?>', $value);
        });
    }

}
