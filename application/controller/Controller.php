<?php
    
    function __autoload($class_name)         {
        include_once("application/models/" . $class_name . ".php");
    }

    

// -- Class Name : Controller
// -- Purpose : 
// -- Created On : 
    class Controller {
        var $user,$databae,$search,$pasturl,$apiResponds;
        public
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

        public
        function check($routes){
            
            if(isset($_SESSION['ID'])){
                $this->Signed_Inactions($routes);
            } else {
                $this->actions($routes);
            }

        }

        public
        function actions($routes){
            
            if (($routes[0] === '')){
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

        public
        function Signed_Inactions($routes){
            
            if (($routes[0] === '')){
                switch ($routes[1]) {
                    case "about":
                        echo "<h1>about</h1>";
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

        public
        function apiCalls($apiCall) {
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
                case "getPopluarSearches.json":
                    $this->apiResponds  = $this->api->getPopluarSearches();
                    break;
                case "signin":
                    $this->user->sign_in();
                    break;
                case "manualImportSearch":
                    $this->search->manualImportSearch();
                    break;
                case "signup":
                    $this->user->register_account();
                    break;
                case "signout":
                    $this->user->logout();
                    break;
                case "deleteaccount":
                    $this->user->delete_account();
                    break;
                 case "updateaccount":
                    $this->user->update_account();
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