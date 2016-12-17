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
    
    public function getUrl($name, $params = array(), $query = array(), $withHost = false){
        return hubert()->router->get($name, $params, $query, $withHost);
    }
    
    public function getBaseUrl($var = "", $withHost = false){
        $url = hubert()->router->getBasePath();
        if ($withHost){
            $request_uri = hubert()->request->getUri();     
            $url = $request_uri->getScheme().'://'.$request_uri->getHost().$url;
        }
        
        if($var && is_string($var)){
            return $url.$var;
        }

        return $url;
    }
    
    public function current_route(){
        if(isset(hubert()->current_route)){
            return hubert()->current_route;
        }
        
        return array("name" => "unknow");
    }
    
    
}
