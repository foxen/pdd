<?php namespace Pdd\Repository\ConfigPdd;

class ConfigPdd implements ConfigPddInterface {

    private $configArray;

    public function __construct(){
        $this->configArray = \Config::get('pdd');
    }

    public function getDomain(){
        return $this->configArray['default_domain'];
    }

    public function getPath(){
        return $this->configArray[$this->getDomain()]['public_folder'];
    }

}