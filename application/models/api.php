<?php
	include_once("application/models/database.php");
    

// -- Class Name : api
// -- Purpose : 
// -- Created On : 
    class api{
        var $database;
        // -- Function Name : __construct
		// -- Params : 
		// -- Purpose : 
 

// -- Function Name : __construct
// -- Params : 
// -- Purpose : 
        public function __construct() {
            $this->database = new database();
        }



// -- Function Name : getUserStates
// -- Params : 
// -- Purpose : 
        public  function getUserStates(){
            $sql = $this->database->count_amount_of_users();
            $results = array();
            $results['amoutofUsers'] = $sql  ;
            return $json = json_encode($results);
        }



// -- Function Name : getSearchStates
// -- Params : 
// -- Purpose : 
        public  function getSearchStates(){
            $sql = $this->database->count_amount_of_searches();
            $results = array();
            $results['numberofSearches'] = $sql ;
            return $json = json_encode($results);
        }

        
        public function getPopluarSearches(){
        
        
        $sql = $this->database->getPopluarSearches();
         
            $rows = array();
while($r = mysqli_fetch_assoc($sql)) {
    $rows[] = $r;
}
return json_encode($rows);
        }

        public function getSystemStates(){
            $sql2 = $this->database->count_amount_of_users();
            $sql = $this->database->count_amount_of_searches();
            $results = array();
            $results['amoutofUsers'] = $sql2 ;
            $results['numberofSearches'] = $sql ;

            return $json = json_encode($results);

        }




    }

    ?>
