<?php

    class Route {

// -- Function Name : __construct
// -- Params : 
// -- Purpose : 
    public
    function __construct() {
		$base_url = $this->getCurrentUri();
		$routes = array();
		$routes = explode('/', $base_url);
		foreach($routes as $route)
		{
			if(trim($route) != ''){
				array_push($routes, $route);
			}
		}

	 
		if($routes[0] == '')
		{
			echo "<h1>Base : Test </h1>";
			if($routes[1] == 'search')
			{
				echo "<h1> fghj</h1>";
			}
		}
    }

	function getCurrentUri()
	{
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
		if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
		$uri = '/' . trim($uri, '/');
		return $uri;
	}











		}
	?>