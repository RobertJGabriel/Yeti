<?php
    

// -- Function Name : __autoload
// -- Params : $class_name
// -- Purpose : 
    function __autoload($class_name)         {
        include_once("application/models/" . $class_name . ".php");
    }

    // -- Class Name : Controller
    // -- Purpose : 
    // -- Created On : 
    
    class Controller {
        var $user,$databae,$search,$pasturl,$apiResponds;
        // -- Function Name : __construct
        // -- Params : 
        // -- Purpose : 
        public

// -- Function Name : __construct
// -- Params : 
// -- Purpose : 
        function __construct() {
            session_start();
            //Used for Development 
            $this->user = new user();
            $this->search = new search();
            $this->database = new database();
            $this->settings = new settings();
            $this->states = new states();
            $this->errors = new errors();
            $this->api = new api();
        }

        // -- Function Name : actions
        // -- Params : 
        // -- Purpose : 
        public

// -- Function Name : actions
// -- Params : $routes
// -- Purpose : 
        function actions($routes)        {
            if ($routes[0] === ''){
            switch ($routes[1]) {
                case "about":
                    echo "<h1>about</h1>";
                    break;
                case "settings":
                    echo "<h1>settings</h1>";
                    break;
                case "search":
                    echo "<h1>search</h1>";
                    break;
                case "login":
                    $this->user->view('signin');
                    break;
                case "signup":
                    $this->user->view('signup');
                    break;
                case "v1":
                    $this->apiCalls($routes[2]); // Calls the api switch Statements 
                    break;
                default:
                    $this->user->view('signin');
            }
        }
    }



// -- Function Name : apiCalls
// -- Params : $apiCall
// -- Purpose : 
        public function apiCalls($apiCall) {
          $this->apiResponds = null;
            switch ($apiCall) {
                case "getusers.json":
                     $this->apiResponds =   $this->api->getUserStates();
                    break;
                case "getsearch.json":
                    $this->apiResponds  = $this->api->getSearchStates();
                    break;
                case "getStates.json":
                    $this->apiResponds  = $this->api->getSystemStates();
                    break;
                case "signin":
                    $this->user->sign_in();
                    break;
                default:
                    echo "None";
            }
            echo  $this->apiResponds;
        }
    }

    ?>