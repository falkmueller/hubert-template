<?php
return array(
    
   "config" => array(
        "display_errors" => true, 
    ),
    "routes" => array(
            "home" => array(
                "route" => "/", 
                "method" => "GET|POST", 
                "target" => function($request, $response, $args){
                    $container = $this->getContainer();
                    $html = $container["template"]->render("index", array("name" => "hubert"));
                    $response->getBody()->write($html);
                    return $response;
                }
            )
        )
);