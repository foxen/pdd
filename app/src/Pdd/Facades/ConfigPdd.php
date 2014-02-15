<?php namespace Pdd\Facades;

use Illuminate\Support\Facades\Facade;
    
class ConfigPdd extends Facade {

    protected static function getFacadeAccessor() { 

        return 'Pdd\Repository\ConfigPdd\ConfigPddInterface'; 

    }

}