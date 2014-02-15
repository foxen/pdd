<?php namespace Pdd\Repository\Input;
use Pdd\Repository\ConfigPdd\ConfigPddInterface;

class Input implements InputInterface{

    private $path;
    private $ConfigPdd;
    private $token;
    private $domain;
    private $hintQ;
    private $hintA;
    private $addressesArray;

    public function __construct(ConfigPddInterface $ConfigPdd){
        $this->ConfigPdd = $ConfigPdd;
        $this->path   = \public_path().'/domains/'.$this->ConfigPdd->getPath();
        $this->token =  explode("\n",file_get_contents($this->path.'/token'))[0];
        $this->domain = $this->ConfigPdd->getDomain();
        $this->hintQ = 'доколе';
        $this->hintA = 'ljnjkt_ljrjkt_';

        $addressesFile =  file_get_contents($this->path.'/addresses.csv');
        
        $rows = explode("\n", $addressesFile);
        
        $this->adressesArray = array();

        foreach($rows as $row){
            if(!empty($row)){ 
                $this->adressesArray[] =  explode(';', $row);       
            }
        }

    }

    public function getRegs(){
        
        $regsArray = array();

        foreach($this->adressesArray as $row){
           
                $regsArray[]=array(
                    'token'  => $this->token,
                    'domain' => $this->domain,
                    'login'  => $row[0],
                    'passwd' => $row[2],);
            
        }
        return $regsArray;
    }

    public function getEdits(){

        $editsArray = array();

        foreach($this->adressesArray as $row){
           
                $editsArray[]=array(
                    'token'       => $this->token,
                    'login'       => $row[0],
                    'passwd'      => $row[2],
                    'domain_name' => $this->domain,
                    'iname'       => $row[5],
                    'fname'       => $row[4],
                    'sex'         => $row[6],
                    'hintq'       => $this->hintQ,
                    'hinta'       => $this->hintA.$row[0],
                );
        }
        return $editsArray;
    }

    public function getImports(){

        $importsArray = array();

        foreach($this->adressesArray as $row){
           
                $importsArray[]=array(
                    'token'       => $this->token,
                    'login'       => $row[0],
                    'password'      => $row[2]
                );
        }
        return $importsArray;        


    }
}

