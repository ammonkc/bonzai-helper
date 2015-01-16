<?php namespace Ammonkc\BonzaiHelper;

use Illuminate\Support\Facades\Facade;

class BonzaiHelperFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bonzaiHelper';
    }

}
