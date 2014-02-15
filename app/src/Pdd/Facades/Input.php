<?php namespace Pdd\Facades;

use Illuminate\Support\Facades\Facade;
    
class Input extends Facade {

    protected static function getFacadeAccessor() { 

        return 'Pdd\Repository\Input\InputInterface'; 

    }

}