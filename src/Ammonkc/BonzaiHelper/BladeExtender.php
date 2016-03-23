<?php

namespace Ammonkc\BonzaiHelper;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\View\Compilers\BladeCompiler as Compiler;

class BladeExtender
{
    public static function attach(Application $app)
    {
        $blade = $app['view']->getEngineResolver()->resolve('blade')->getCompiler();
        $class = new static;
        foreach (get_class_methods($class) as $method) {
            if ($method == 'attach') {
                continue;
            }

            $blade->directive($method, function ($expression) use ($app, $class, $blade, $method) {
                return $class->$method($expression);
            });
        }
    }

    public function javascript($expression)
    {
        return "<?php echo Bonzai::javascript($expression); ?>";
    }

    public function javascript_secure($expression)
    {
        return "<?php echo Bonzai::javascript_secure($expression); ?>";
    }

    public function stylesheet($expression)
    {
        return "<?php echo Bonzai::stylesheet($expression); ?>";
    }

    public function stylesheet_secure($expression)
    {
        return "<?php echo Bonzai::stylesheet_secure($expression); ?>";
    }

    public function image($expression)
    {
        return "<?php echo Bonzai::image($expression); ?>";
    }

    public function image_secure($expression)
    {
        return "<?php echo Bonzai::image_secure($expression); ?>";
    }

    public function icon($expression)
    {
        return "<?php echo Bonzai::icon($expression); ?>";
    }

    public function icon_secure($expression)
    {
        return "<?php echo Bonzai::icon_secure($expression); ?>";
    }

    public function jquery($expression)
    {
        return "<?php echo Bonzai::jquery($expression); ?>";
    }

    public function ckeditor($expression)
    {
        return "<?php echo Bonzai::ckeditor($expression); ?>";
    }
}
