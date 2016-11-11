<?php

namespace hubert\extension\template;

class factory {
    public static function get($container){
        $engine =  new \League\Plates\Engine(hubert()->config()->template["path"]);
    
        $engine->setFileExtension(hubert()->config()->template["fileExtension"]);
        if(isset(hubert()->config()->template["extensions"])){
            foreach (hubert()->config()->template["extensions"] as $classname){
                $engine->loadExtension(new $classname());
            }
        }
        
        return $engine;
    }
}
