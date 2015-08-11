<?php

        function __autoload($class_name) 
        {
           include_once("application/models/" . $class_name . ".php");
        }

// -- Class Name : Controller
// -- Purpose : 
// -- Created On : 
    class Controller {
        var $user,$databae,$search,$pasturl;



// -- Function Name : __construct
// -- Params : 
// -- Purpose : 
        public
        function __construct() {
            session_start();
            $this->user = new user();
            $this->search = new search();
            $this->database = new database();
            $this->settings = new settings();
            $this->states = new states();
            $this->errors = new errors();
        }






// -- Function Name : pastUrl
// -- Params : 
// -- Purpose : 
        public
        function pastUrl(){
            
            if(isset($_SERVER['HTTP_REFERER']))        {
                $this->pasturl =$_SERVER['HTTP_REFERER'];
                return $this->pasturl;
            }

        }






// -- Function Name : checkifAction
// -- Params : 
// -- Purpose : 
        public
        function checkifAction(){
            $action ;
            
            if(isset( $_GET['action'])){
                $action =   $_GET['action'];
            } else
            if(isset( $_GET['q'])){
                $action =   $_GET['q'];
            } else {
                $action = 'home';
            }

            return $action;
        }


// -- Function Name : signinedIn
// -- Params : $actions
// -- Purpose : 
        public
        function signinedIn($actions){
            switch ($actions) {
                case "home":
                    include_once( WEBSITE_PATH . 'application/views/results.html');
                    break;
                case "logout":
                    $this->user->logout();
                    $number_of_users =  $this->database->count_amount_of_users();
                    $number_of_searches = $this->database->count_amount_of_searches();
                    include_once(WEBSITE_PATH . 'application/views/signin.html');
                    break;
                case "settings":
                    include_once(WEBSITE_PATH . 'application/views/setting.html');
                    break;
                case 'getSearch_Chart':
                    $this->states->search_chart();
                    break;
                case 'charts':
                    include_once(WEBSITE_PATH . 'application/views/charts.html');
                    break;
                case 'delete_account':
                    $this->user->delete_account();
                    $this->user->logout();
                    break;
                case 'update_account':
                    $this->user->update_account();
                    break;
                case 'search':
                    $this->search->add_search();
                    include_once(WEBSITE_PATH . 'application/views/results.html');
                    break;
                case 'webresults':
                    // $this->search->bing();
                    $this->search->add_search();
                    break;
                default:
                    $number_of_searches = $this->database->count_amount_of_searches();
                    $number_of_users =  $this->database->count_amount_of_users();
                    include_once(WEBSITE_PATH .'application/views/signin.html');
                }

        }


// -- Function Name : NotSignedIn
// -- Params : $actions
// -- Purpose : 
        public
        function NotSignedIn($actions){
            switch ($actions) {
                case "signin":
                    $this->user->sign_in();
                    break;
                case 'signup':
                    include_once('application/views/signup.html');
                    break;
                case 'signinview':
                    $number_of_searches = $this->database->count_amount_of_searches();
                    $number_of_users =  $this->database->count_amount_of_users();
                    include_once(WEBSITE_PATH . 'application/views/signin.html');
                    break;
                case 'search':
                    include_once('application/views/results.html');
                    break;
                case 'register':
                    echo  $this->user->register_account();
                    break;
                default:
                    $number_of_searches = $this->database->count_amount_of_searches();
                    $number_of_users =  $this->database->count_amount_of_users();
                    include_once(WEBSITE_PATH . 'application/views/signin.html');
                }

        }


// -- Function Name : invoke
// -- Params : 
// -- Purpose : 
        public
        function invoke(){
            $actions = $this->checkifAction();
            
            if(isset( $_SESSION['ID'])){
                $this->signinedIn($actions);
            } else {
                $this->NotSignedIn($actions);
            }

        }

    }

    ?>