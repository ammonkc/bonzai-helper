<?php namespace Ammonkc\BonzaiHelper;

use Illuminate\Support\Facades\Config;

class BonzaiHelper
{
    /**
     * Ouput the stylesheet
     *
     * @return string
     */
    public function stylesheet($css, $rev = false, $media = 'all')
    {
        $ext = '.css';
        $min = '.min';
        $assetDir = Config::get('bonzai-helper::assetDir', 'assets');
        $buildDir = Config::get('bonzai-helper::buildDir', 'assets/build');
        $secure = app('request')->secure();
        $link = '';
        static $manifest = null;

        if ($rev)
        {
            if (is_null($manifest))
            {
                $manifest = json_decode(file_get_contents(public_path() . '/' . $buildDir .'/manifests/css-manifest.json'), true);
            }
        }

        if ( is_array($css) )
        {
            foreach ($css as $asset) {
                $file = pathinfo($asset);
                if ( app()->environment('production') )
                {
                    $asset = str_finish( (ends_with($file['filename'], $min) ? $file['filename'] : str_finish($file['filename'], $min)), $ext );
                }
                else
                {
                    $asset = str_finish( $file['filename'], $ext);
                }
                $path = ($rev && isset($manifest[$asset]) ? $buildDir . '/' . $manifest[$asset] : $assetDir . '/css/' . $asset);
                $url = app('url')->asset($path, $secure);
                $link .= '<link href="' . $url . '" rel="stylesheet" type="text/css" media="' . $media . '">';
            }
        }
        else
        {
            $file = pathinfo($css);

            if ( app()->environment('production') )
            {
                $css = str_finish( (ends_with($file['filename'], $min) ? $file['filename'] : str_finish($file['filename'], $min)), $ext );
            }
            else
            {
                $css = str_finish( $file['filename'], $ext);
            }

            $path = ($rev && isset($manifest[$css]) ? $buildDir . '/' . $manifest[$css] : $assetDir . '/css/' . $css);
            $url = app('url')->asset($path, $secure);
            $link = '<link href="' . $url . '" rel="stylesheet" type="text/css">';
        }

        return $link;
    }

    /**
     * Ouput the stylesheet_secure
     *
     * @return string
     */
    public function stylesheet_secure($css, $rev = false)
    {
        $ext = '.css';
        $min = '.min';
        $assetDir = Config::get('bonzai-helper::assetDir', 'assets');
        $buildDir = Config::get('bonzai-helper::buildDir', 'assets/build');
        $link = '';
        static $manifest = null;

        if ($rev)
        {
            if (is_null($manifest))
            {
                $manifest = json_decode(file_get_contents(public_path() . '/' . $buildDir .'/manifests/css-manifest.json'), true);
            }
        }

        if ( is_array($css) )
        {
            foreach ($css as $asset) {
                $file = pathinfo($asset);

                if ( app()->environment('production') )
                {
                    $asset = str_finish( (ends_with($file['filename'], $min) ? $file['filename'] : str_finish($file['filename'], $min)), $ext );
                }
                else
                {
                    $asset = str_finish( $file['filename'], $ext);
                }

                $path = ($rev && isset($manifest[$asset]) ? $buildDir . '/' . $manifest[$asset] : $assetDir . '/css/' . $asset);
                $url = app('url')->asset($path, true);
                $link .= '<link href="' . $url . '" rel="stylesheet" type="text/css">';
            }
        }
        else
        {

            $file = pathinfo($css);

            if ( app()->environment('production') )
            {
                $css = str_finish( (ends_with($file['filename'], $min) ? $file['filename'] : str_finish($file['filename'], $min)), $ext );
            }
            else
            {
                $css = str_finish( $file['filename'], $ext);
            }

            $path = ($rev && isset($manifest[$css]) ? $buildDir . '/' . $manifest[$css] : $assetDir . '/css/' . $css);
            $url = app('url')->asset($path, true);
            $link = '<link href="' . $url . '" rel="stylesheet" type="text/css">';
        }

        return $link;
    }

    /**
     * Ouput the javascript
     *
     * @return string
     */
    public function javascript($js, $rev = false)
    {
        $ext = '.js';
        $min = '.min';
        $assetDir = Config::get('bonzai-helper::assetDir', 'assets');
        $buildDir = Config::get('bonzai-helper::buildDir', 'assets/build');
        $secure = app('request')->secure();
        $script = '';
        static $manifest = null;

        if ($rev)
        {
            if (is_null($manifest))
            {
                $manifest = json_decode(file_get_contents(public_path() . '/' . $buildDir .'/manifests/js-manifest.json'), true);
            }
        }

        if ( is_array($js) )
        {
            foreach ($js as $asset) {
                $file = pathinfo($asset);

                if ( app()->environment('production') )
                {
                    $asset = str_finish( (ends_with($file['filename'], $min) ? $file['filename'] : str_finish($file['filename'], $min)), $ext );
                }
                else
                {
                    $asset = str_finish( $file['filename'], $ext);
                }

                $path = ($rev && isset($manifest[$asset]) ? $buildDir . '/' . $manifest[$asset] : $assetDir . '/js/' . $asset);
                $url = app('url')->asset($path, $secure);
                $script .= '<script src="' . $url . '" type="text/javascript"></script>';
            }
        }
        else
        {

            $file = pathinfo($js);

            if ( app()->environment('production') )
            {
                $js = str_finish( (ends_with($file['filename'], $min) ? $file['filename'] : str_finish($file['filename'], $min)), $ext );
            }
            else
            {
                $js = str_finish( $file['filename'], $ext);
            }

            $path = ($rev && isset($manifest[$js]) ? $buildDir . '/' . $manifest[$js] : $assetDir . '/js/' . $js);
            $url = app('url')->asset($path, $secure);
            $script = '<script src="' . $url . '" type="text/javascript"></script>';
        }

        return $script;
    }

    /**
     * Ouput the javascript_secure
     *
     * @return string
     */
    public function javascript_secure($js, $rev = false)
    {
        $ext = '.js';
        $min = '.min';
        $assetDir = Config::get('bonzai-helper::assetDir', 'assets');
        $buildDir = Config::get('bonzai-helper::buildDir', 'assets/build');
        $script = '';
        static $manifest = null;

        if ($rev)
        {
            if (is_null($manifest))
            {
                $manifest = json_decode(file_get_contents(public_path() . '/' . $buildDir .'/manifests/js-manifest.json'), true);
            }
        }

        if ( is_array($js) )
        {
            foreach ($js as $asset) {
                $file = pathinfo($asset);

                if ( app()->environment('production') )
                {
                    $asset = str_finish( (ends_with($file['filename'], $min) ? $file['filename'] : str_finish($file['filename'], $min)), $ext );
                }
                else
                {
                    $asset = str_finish( $file['filename'], $ext);
                }

                $path = ($rev && isset($manifest[$asset]) ? $buildDir . '/' . $manifest[$asset] : $assetDir . '/js/' . $asset);
                $url = app('url')->asset($path, true);
                $script .= '<script src="' . $url . '" type="text/javascript"></script>';
            }
        }
        else
        {
            $file = pathinfo($js);

            if ( app()->environment('production') )
            {
                $js = str_finish( (ends_with($file['filename'], $min) ? $file['filename'] : str_finish($file['filename'], $min)), $ext );
            }
            else
            {
                $js = str_finish( $file['filename'], $ext);
            }

            $path = ($rev && isset($manifest[$js]) ? $buildDir . '/' . $manifest[$js] : $assetDir . '/js/' . $js);
            $url = app('url')->asset($path, true);
            $script = '<script src="' . $url . '" type="text/javascript"></script>';
        }

        return $script;
    }

    /**
     * Ouput the jquery
     *
     * @return string
     */
    public function jquery($version, $cdn = true)
    {
        $ext = '.js';
        $prefix = 'jquery';
        $min = '.min';
        $assetDir = Config::get('bonzai-helper::assetDir', 'assets') . '/js/';
        $secure = app('request')->secure();
        $file = pathinfo($version);
        $version = preg_replace('/^' . preg_quote($prefix.'-', '/') . '/', '', (ends_with($file['filename'], $min) ? pathinfo($file['filename'], PATHINFO_FILENAME) : (ends_with($file['basename'], $ext) ? $file['filename'] : $file['basename'])));
        $jquery = $prefix . $min . $ext;
        $path =  $assetDir . $jquery;
        $url = app('url')->asset($path, $secure);

        $script = '<script src="' . $url . '" type="text/javascript"></script>';

        if ($cdn)
        {
            $scriptCdn  = '<script src="//ajax.googleapis.com/ajax/libs/jquery/' . $version . '/jquery.min.js"></script>';
            $scriptCdn .= '<script>window.jQuery || document.write(\'<script src="' . $url . '"><\/script>\')</script>';
            $script = $scriptCdn;
        }

        return $script;
    }

    /**
     * Ouput the image
     *
     * @return string
     */
    public function image($img, $class = null)
    {
        $path = Config::get('bonzai-helper::assetDir', 'assets') . '/img/' . $img;
        $secure = app('request')->secure();
        $url = app('url')->asset($path, $secure);
        return '<img src="' . $url . '" class="' . $class . '">';
    }

    /**
     * Ouput the image_secure
     *
     * @return string
     */
    public function image_secure($img, $class = null)
    {
        $path = Config::get('bonzai-helper::assetDir', 'assets') . '/img/' . $img;
        $url = app('url')->asset($path, true);
        return '<img src="' . $url . '" class="' . $class . '">';
    }

    /**
     * Ouput the icon
     *
     * @return string
     */
    public function icon($ico, $rel = 'shortcut icon')
    {
        $path = Config::get('bonzai-helper::assetDir', 'assets') . '/ico/' . $ico;
        $secure = app('request')->secure();
        $url = app('url')->asset($path, $secure);
        return '<link src="' . $url . '" rel="' . $rel . '">';
    }

    /**
     * Ouput the icon_secure
     *
     * @return string
     */
    public function icon_secure($ico, $rel = 'shortcut icon')
    {
        $path = Config::get('bonzai-helper::assetDir', 'assets') . '/ico/' . $ico;
        $url = app('url')->asset($path, true);
        return '<link src="' . $url . '" rel="' . $rel . '">';
    }
}
