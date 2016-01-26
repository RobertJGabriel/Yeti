<?php
    // -- Class Name : errors
    // -- Purpose : 
    // -- Created On : 
    
    class errors {

// -- Function Name : __construct
// -- Params : 
// -- Purpose : 
        public function __construct() {
            $this->errorHandling();
            $this->showErrors();
        }


// -- Function Name : errorHandling
// -- Params : 
// -- Purpose : 
        public function errorHandling(){
            ini_set("html_errors", 1);
            ini_set("error_prepend_string", "<pre style='color: #333; font-face:monospace; font-size:8pt;'>");
            ini_set("error_append_string ", "</pre>");
        }


// -- Function Name : formatting
// -- Params : 
// -- Purpose : 
        public function formatting(){
            //Need to do
        }


// -- Function Name : showErrors
// -- Params : 
// -- Purpose : 
        public function showErrors(){
            ini_set('display_errors',1);
            ini_set('display_startup_errors',1);
            error_reporting(-1);
        }

    }

    ?>