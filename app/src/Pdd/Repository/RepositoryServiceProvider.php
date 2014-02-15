<?php namespace Pdd\Repository;

use Illuminate\Support\ServiceProvider;
use Pdd\Repository\Input\Input;
use Pdd\Repository\ConfigPdd\ConfigPdd;
use Pdd\Repository\Pdd\Pdd;

class RepositoryServiceProvider extends ServiceProvider {
    
    public function register(){
        $app = $this->app;
        
        $app->bind('Pdd\Repository\Input\InputInterface', function($app){        
            return new Input(
                $app->make(
                    'Pdd\Repository\ConfigPdd\ConfigPddInterface'
                ));
        });

        $app->bind('Pdd\Repository\Pdd\PddInterface', function($app){        
            return new Pdd(
                $app->make(
                    'Pdd\Repository\Input\InputInterface'
                ));
        });

        $app->bind('Pdd\Repository\ConfigPdd\ConfigPddInterface', function(){        
            return new ConfigPdd;
        });
    
    }
}