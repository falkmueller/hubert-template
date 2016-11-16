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
    
    public function getUrl($name, $params = array(), $query = array()){
        return hubert()->router->get($name, $params, $query);
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
