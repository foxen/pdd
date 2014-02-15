<?php namespace Pdd\Repository\Pdd;
use Pdd\Repository\Input\InputInterface;

class Pdd implements PddInterface{

    private $Input;

    public function __construct(InputInterface $Input){
        $this->Input = $Input;
    }

    public function CreateUpdate(){
        //$this->Create(true);
        $this->Update(true);
    }

    public function Create($output = false){
        
        $createsArray = $this->Input->getRegs();

        $resArray = array();

        if($output){
            echo 'Creating...'.'<br>';
        }

        foreach ($createsArray as $box) {
            
            $url =\cURL::buildUrl("https://pddimp.yandex.ru/api/reg_user.xml",$box);
            $response = (array) simplexml_load_string(\cURL::get($url))->status;

            if(empty($response['error'])){
                
                $result = 'success';
            
            }else{
                
                $result = $response['error'];
            
            }

            if($output){
                echo $box['login'].' - '.$result.'<br>';
            }            

            $resArray[]=array($box['login'] => $result);

        }

        
        return $resArray;
    }
    
    public function Update($output = false){

        $createsArray = $this->Input->getEdits();

        $resArray = array();

        if($output){
            echo 'Updating...'.'<br>';
        }

        foreach ($createsArray as $box) {
            

            $url =\cURL::buildUrl("https://pddimp.yandex.ru/edit_user.xml",$box);
            $response = (array) \cURL::get($url);
            $response = (array)simplexml_load_string($response['body']);
            
            $result = 'error';

            if(empty($response['error'])){
                $result = 'success';
            }else{
                $response = (array) $response['error'];
                if($response['@attributes']['reason'] == 'unknown'){
                    $result = 'success';
                }
            }
            
             if($output){
                echo $box['login'].' - '.$result.'<br>';
            }
            
            $resArray[]=array($box['login'] => $result);    

        }

        
        return $resArray;

    }
}

