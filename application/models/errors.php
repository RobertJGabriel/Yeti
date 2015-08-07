<?php


 class errors {
     


        public
        function __construct() {
          $this->errorHandling();
          $this->showErrors();
        }


        public
        function errorHandling(){
        	ini_set("html_errors", 1); 
			ini_set("error_prepend_string", "<pre style='color: #333; font-face:monospace; font-size:8pt;'>"); 
			ini_set("error_append_string ", "</pre>"); 
        }


        public
        function formatting(){



        }

        // -- Function Name : showErrors
		// -- Params : 
		// -- Purpose : 
        public
        function showErrors(){
            ini_set('display_errors',1);
            ini_set('display_startup_errors',1);
            error_reporting(-1);
        }


 }



?>