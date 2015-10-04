<?php
    include_once("application/models/database.php");
    include_once("application/models/search.php");
    // -- Class Name : api
    // -- Purpose : 
    // -- Created On : 
    
    class api{
        var $database,$search;

        public
        function __construct() {
            $this->database = new database();
                     $this->search = new search();

        }
        public function getApiKey(){
            $results = array();
            $results['apikey'] = $_SESSION["apikey"]  ;
         return   $json = json_encode($results);
         
        }

        public
        function getUserStates(){
            $sql = $this->database->count_amount_of_users();
            $results = array();
            $results['amoutofUsers'] = $sql  ;
            return $json = json_encode($results);
        }

        public
        function getUserinfo(){

            $sql = $this->database->getUpdateInfo($_SESSION['ID']);
            $rows = array();
            while($r = mysqli_fetch_assoc($sql)) {
                $rows[] = $r;
            }

            return json_encode($rows);



        }

        public
        function getSearchStates(){
            $sql = $this->database->count_amount_of_searches();
            $results = array();
            $results['numberofSearches'] = $sql ;
            return $json = json_encode($results);
        }

        public
        function getSearches($key,$term){
            $companyId = $this->database->getCompanyByKey($key);
            
            if ($companyId !== ""){
                $sql = $this->database->getSearch($companyId,$term);
          
                $rows = array();
                while($r = mysqli_fetch_assoc($sql)) {
                    $rows[] = $r;
                }
                $rows[] =  $this->search->duckduckgo($term);


                return json_encode($rows);
            } else {
           return json_encode('none');
            }

        }

        public
        function getPopluarSearches(){
            $sql = $this->database->getPopluarSearches();
            $rows = array();
            while($r = mysqli_fetch_assoc($sql)) {
                $rows[] = $r;
            }

            return json_encode($rows);
        }

        public
        function getSystemStates(){
            $sql2 = $this->database->count_amount_of_users();
            $sql = $this->database->count_amount_of_searches();
            $results = array();
            $results['amoutofUsers'] = $sql2 ;
            $results['numberofSearches'] = $sql ;
            return $json = json_encode($results);
        }

    }

    ?>