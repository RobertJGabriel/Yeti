<?php

    include_once("application/models/database.php");
    

// -- Class Name : api
// -- Purpose : 
// -- Created On : 
    class api{
        var $database;

        public
        function __construct() {
            $this->database = new database();
        }

        public
        function getUserStates(){
            $sql = $this->database->count_amount_of_users();
            $results = array();
            $results['amoutofUsers'] = $sql  ;
            return $json = json_encode($results);
        }

        public
        function getSearchStates(){
            $sql = $this->database->count_amount_of_searches();
            $results = array();
            $results['numberofSearches'] = $sql ;
            return $json = json_encode($results);
        }


        public
        function getSearches($key){
       $companyId = $this->database->getCompanyByKey($key);

if ($companyId !== ""){
           $sql = $this->database->getSearch($companyId);

            $rows = array();
            while($r = mysqli_fetch_assoc($sql)) {
                $rows[] = $r;
            }

            return json_encode($rows);
        }else{

            return 'ss';
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