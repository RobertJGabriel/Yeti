<?php

	include_once("application/controller/controller.php");

    class Route {
	
    public
    function __construct() {
			
		$controller = new controller();
    	$controller->invoke();




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
			echo "<h1>Homepage</h1>";
			if($routes[1] == 'about')
			{
				echo "<h1>about</h1>";
			}

			if($routes[1] == 'settings')
			{
				echo "<h1>about</h1>";
			}
			
			if($routes[1] == 'search')
			{
				echo "<h1>search</h1>";
			}
			
			if($routes[1] == 'login')
			{
				echo "<h1>login</h1>";
			}
		if($routes[1] == 'signup')
			{
				echo "<h1>signup</h1>";
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