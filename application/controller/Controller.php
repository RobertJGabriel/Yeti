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
        public  function __construct() {
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



// -- Function Name : check
// -- Params : $routes
// -- Purpose : 
        public  function check($routes){
            
            if(isset($_SESSION['ID'])){
                $this->Signed_Inactions($routes);
            } else {
                $this->actions($routes);
            }

        }


// -- Function Name : actions
// -- Params : $routes
// -- Purpose : 
        public  function actions($routes){
            
            if (($routes[0] === '')){
                switch ($routes[1]) {
                    case "about":
                        echo "<h1>about</h1>";
                        break;
                    case "settings":
                        echo "<h1>settings</h1>";
                        break;
                    case "delete":
                        echo "<h1>delete</h1>";
                        break;
                    case "search":
                        $this->user->view('results');
                        break;
                    case "pricing":
                        $this->user->view('home');
                        break;
                    case "download":
                        $this->user->view('home');
                        break;
                    case "contact":
                        $this->user->view('home');
                        break;
                    case "login":
                        $this->user->view('signin');
                        break;
                    case "signup":
                        $this->user->view('signup');
                        break;
                    case "features":
                        $this->user->view('home');
                        break;
                    case "v1":
                        $this->apiCalls($routes[2]);
                        // Calls the api switch Statements 
                        break;
                    default:
                        $this->user->view('home');
                    }

            }

        }

// -- Function Name : Signed_Inactions
// -- Params : $routes
// -- Purpose : 
        public  function Signed_Inactions($routes){

            if (($routes[0] === '')){
                switch ($routes[1]) {
                    case "about":
                        echo "<h1>about</h1>";
                        break;
                    case "search":
                        $this->user->view('results');
                        break;
                    case "v1":
                        $this->apiCalls($routes[2]);
                        // Calls the api switch Statements 
                        break;
                    default:
                        $this->user->view('panel');
                    }
            }
        }

// -- Function Name : apiCalls
// -- Params : $apiCall
// -- Purpose : 
        public   function apiCalls($apiCall) {
            $this->apiResponds = null;
            switch ($apiCall) {
                case "getusers.json":
                    $this->apiResponds =   $this->api->getUserStates();
                    break;
                case "me.json":
                    $this->apiResponds =   $this->api->getUserinfo();
                    break;
                case "getsearch.json":
                    $this->apiResponds  = $this->api->getSearchStates();
                    break;
                case "getStates.json":
                    $this->apiResponds  = $this->api->getSystemStates();
                    echo 'ss';
                    break;
                case "getPopluarSearches.json":
                    $this->apiResponds  = $this->api->getPopluarSearches();
                    break;
                case "getsearches.json":
                    if(isset($_GET["term"])){   $term = $_GET["term"];} else { $term = 'a';}
                    $this->apiResponds  = $this->api->getSearches($_GET['apikey'],$term);
                    //$this->apiResponds  .= $this->search->duckduckgo($term);
                    break;
                case "getApiCode.json":
                    $this->apiResponds  = $this->api->getApiKey();
                    break;
                case "getCode":
                    echo "
                        <form action='http://yettii.azurewebsites.net/" ."/search?apikey=" .  $_SESSION["apikey"] . "&term=Howdeep is your love" ."'>
                            <input type='text' name='term' value='Search the world with yeti'>
                            <br>
                            <input type='submit' value='Submit'>
                        </form>
                        ";
                    break;
                case "signin":
                    $this->user->sign_in();
                    break;
                case "manualImportSearch":
                    $this->search->manualImportSearch();
                    break;
                case "viewSearch":
                    header("Location: " . "/search?apikey=" .  $_SESSION["apikey"] . "&term=bat" );
                    die();
                    break;
                case "signup":
                    $this->user->register_account();
                    break;
                case "signout":
                    $this->user->logout();
                    break;
                case "deleteaccount":
                    $this->user->delete_account();
                    $this->user->logout();
                    break;
                case "updateAccount":
                    
                    if($this->user->update_account()){
                        print_r("true");
                    } else {
                        print_r("fail update");
                    }
                    break;
                case "updateSearchSettings":
                    $this->user->updateSearch_Settings();
                    break;
                default:
                    echo "None";
                }

            echo  $this->apiResponds;
        }

    }

?>