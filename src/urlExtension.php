<?php 
namespace hubert\extension\template;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class urlExtension implements ExtensionInterface {

    public function register(Engine $engine)
    {
        $engine->registerFunction('url', [$this, 'getUrl']);
        $engine->registerFunction('baseUrl', [$this, 'getBaseUrl']);
        $engine->registerFunction('current_route', [$this, 'current_route']);
    }
    
    public function getUrl($var){
        if(is_string($var)){
            return hubert()->router->get($var);
        }
        elseif (is_array($var)){
            return hubert()->router->get($var["name"], isset($var["params"]) ? $var["params"] : array(), isset($var["get"]) ? $var["get"] : array());
        }
        
        return "";
    }
    
    public function getBaseUrl($var = ""){
        if($var && is_string($var)){
            return hubert()->router->getBasePath().$var;
        }
        
        
        return hubert()->router->getBasePath();
    }
    
    public function current_route(){
        if(isset(hubert()->current_route)){
            return hubert()->current_route;
        }
        
        return array("name" => "unknow");
    }
    
    
}
