<?php namespace Pdd\Facades;

use Illuminate\Support\Facades\Facade;
    
class Pdd extends Facade {

    protected static function getFacadeAccessor() { 

        return 'Pdd\Repository\Pdd\PddInterface'; 

    }

}