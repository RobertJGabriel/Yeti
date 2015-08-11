<?php


	include_once("application/controller/controller.php");
    

// -- Class Name : Route
// -- Purpose : 
// -- Created On : 
    class Route {


// -- Function Name : __construct
// -- Params : 
// -- Purpose : 
        public function __construct() {
            $controller = new controller();
            //   	$controller->invoke();
            $base_url = $this->getCurrentUri();
            $routes = array();
            $routes = explode('/', $base_url);
            foreach($routes as $route){
                
                if(trim($route) != ''){
                    array_push($routes, $route);
                }

            }

            $controller->actions($routes); // Calls and sends the url example http://localhost/yeti/login will be auto routes[1] = login
        }

        

// -- Function Name : getCurrentUri
// -- Params : 
// -- Purpose : 
        function getCurrentUri(){
            $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
            $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
            
            if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
            $uri = '/' . trim($uri, '/');
            return $uri;
        }

    }

    ?>