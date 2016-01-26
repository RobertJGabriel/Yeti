<?php
    // -- Class Name : database
    // -- Purpose : To Connect and run sql querys to the database 
    // -- Created On : 21/03/2015
    
    class database{
        var $username = "root";
        var $password= "";
        var $host = "localhost";
        var $database = "yeti";
        var $con;

// -- Function Name : __construct
// -- Params : 
// -- Purpose : 
        public function __construct()   {

            $this->con=mysqli_connect($this->host,$this->username,$this->password,$this->database);    
            
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
        }

// -- Function Name : __destruct
// -- Params : 
// -- Purpose : 
        public  function __destruct(){
            mysqli_close($this->con);
        }

// -- Function Name : sign_in
// -- Params : $email,$password
// -- Purpose : 
        public  function sign_in($email,$password){
            $sql_query = "SELECT `id`,`firstName`,`lastName`,`website`,`email`,`password`, `twitter`,`companyId`,`salt` FROM `users` WHERE email ='" . $email . "' AND password ='" . $password ."'";
            return $this->runSQL($sql_query);
        }


// -- Function Name : getsalt
// -- Params : $email
// -- Purpose : 
        public  function getsalt($email)        {
            $sql_query = "SELECT `salt` FROM `users` WHERE email ='" . $email . "'";
            $result =   $this->runSQL($sql_query);
            $displayAsString = mysqli_fetch_array($result);
            return  $displayAsString[0];
        }

// -- Function Name : getCompanyByKey
// -- Params : $key
// -- Purpose : 
        public  function getCompanyByKey($key)        {
            $sql_query = "SELECT `companyId` FROM `users` WHERE salt ='" . $key . "'";
            $result =   $this->runSQL($sql_query);
            $displayAsString = mysqli_fetch_array($result);
            return  $displayAsString[0];
        }

// -- Function Name : getsaltpassword
// -- Params : $email
// -- Purpose : 
        public function getsaltpassword($email)        {
            $sql_query = "SELECT `password` FROM `users` WHERE email ='" . $email . "'";
            $result =   $this->runSQL($sql_query);
            $displayAsString = mysqli_fetch_array($result);
            return  $displayAsString[0];
        }


// -- Function Name : getUpdateInfo
// -- Params : $userId
// -- Purpose : 
        public  function getUpdateInfo($userId){
            $sql_query = "SELECT `firstName`, `lastname`, `email` FROM `users` WHERE id='" . $userId . "'";
            return $this->runSQL($sql_query);
        }

// -- Function Name : register_account
// -- Params : $firstName,$lastName,$website,$email,$password,$salt,$companyId
// -- Purpose : 
        public function register_account($firstName,$lastName,$website,$email,$password,$salt,$companyId){
            $sql_query = "  INSERT INTO 
                                `users`(`firstName`,`lastName`,`website`, `email`, `password`,`salt`,`twitter`,`companyId`) 
                            VALUES ('" . $firstName  ."','" . $lastName  ."','" . $website  ."','" . $email  ."','" . $password  ."','".  $salt ."',0,'". $companyId .  "')";
            $this->runSQL($sql_query);
        }

// -- Function Name : importSearch
// -- Params : $title,$description,$url_or_link,$information,$manualImported,$companyId
// -- Purpose : 
        public function importSearch($title,$description,$url_or_link,$information,$manualImported,$companyId){
            $sql_query = "  INSERT INTO 
                                `files`(`title`,`description`,`url`, `information`, `manual`, `companyId`) 
                            VALUES ('" . $title  ."','" . $description  ."','" . $url_or_link  ."','". $information  ."','" . $manualImported  ."','" . $companyId  ."')";
            $this->runSQL($sql_query);
        }



// -- Function Name : getPopluarSearches
// -- Params : 
// -- Purpose : 
        public   function getPopluarSearches(){
            $sql_query = "SELECT `search_term`,`userID`,`date`,`time`,`location` FROM `searches`  WHERE `companyId` = '" . $_SESSION["companyId"] .  "' GROUP BY search_term";
            return $this->runSQL($sql_query);
        }


// -- Function Name : check_if_company_exists
// -- Params : $companyName
// -- Purpose : 
        public  function check_if_company_exists($companyName){
            $sql_query = "SELECT count(companyId)  FROM `company` where companyName='" . $companyName ."'";
            $result =   $this->runSQL($sql_query);
            $count = mysqli_fetch_array($result);
            return  $count[0];
        }

// -- Function Name : createCompany
// -- Params : $companyName
// -- Purpose : 
        public function createCompany($companyName){
            $sql_query = "  INSERT INTO `company`(`companyName`,`paided`,`plan`) 
                            VALUES ('" . $companyName  ."','0','0')";
            $this->runSQL($sql_query);
        }

// -- Function Name : createCompanySettings
// -- Params : $companyName
// -- Purpose : 
        public function createCompanySettings($companyName){
            $sql_query = "  INSERT INTO `settings`(`companyId`) 
                            VALUES ('" . $this->getCompanyId($companyName)  ."')";
            $this->runSQL($sql_query);
        }

// -- Function Name : getCompanyId
// -- Params : $companyName
// -- Purpose : 
        public  function getCompanyId($companyName){
            $sql_query = "SELECT companyId  FROM `company` where companyName='" . $companyName ."'";
            $result =   $this->runSQL($sql_query);
            $count = mysqli_fetch_array($result);
            return  $count[0];
        }


// -- Function Name : delete_account
// -- Params : $id
// -- Purpose : 
        public function delete_account($id){
            $sql_query = "DELETE FROM users WHERE id='" . $id ."'";
            $this->runSQL($sql_query);
        }


// -- Function Name : update_account
// -- Params : $firstName, $lastName, $email
// -- Purpose : 
        public function update_account($firstName, $lastName, $email){
            $sql;
            $sql = "UPDATE " .self::$users_table." SET ";
            $sql .= "email= '" . $this->escape_string($email ). "', ";
            $sql .= "firstName= '" . $this->escape_string($firstName ). "', ";
            $sql .= "lastName= '" . $this->escape_string( $lastName). "' ";
            $sql .= "WHERE id= " . $this->escape_string($_SESSION["ID"]);
            return $this->runSQL($sql);
        }

        

// -- Function Name : count_amount_of_users
// -- Params : 
// -- Purpose : 
        public function count_amount_of_users(){
            $sql_query = "SELECT count(id) as count FROM `users`";
            $result =$this->runSQL($sql_query);
            $count = mysqli_fetch_array($result);
            return   $count[0];
        }


// -- Function Name : check_if_account_exists
// -- Params : $email
// -- Purpose : 
        public function check_if_account_exists($email){
            $sql_query = "SELECT count(id)  FROM `users` where email='" . $email ."'";
            $result =   $this->runSQL($sql_query);
            $count = mysqli_fetch_array($result);
            return  $count[0];
        }



// -- Function Name : add_search
// -- Params : $searchterm, $id
// -- Purpose : 
        public function add_search($searchterm, $id){
            $sql_query = " INSERT INTO `searches`(`search_term`, `userID`, `date`, `time`) VALUES ('" .$searchterm ."','". $id ."','" . date("d-m-y") . "','" .   date("h:i:sa")."')";
            $this->runSQL($sql_query);
        }


// -- Function Name : amount_of_searches
// -- Params : 
// -- Purpose : 
        public function amount_of_searches(){
            $sql_query = "SELECT Distinct count(date) as Number , date 
                            FROM searches 
                            GROUP BY date";
            return  $this->runSQL($sql_query);
        }


// -- Function Name : getSearch
// -- Params : $companyId,$term
// -- Purpose : 
        public function getSearch($companyId,$term){
            $sql_query = "SELECT `title`,`description`,`information`,`url`,`manual` FROM `files`  WHERE (`companyId` ='". $companyId .  "') AND (`title` LIKE  '" . $term  ."%')";
            return  $this->runSQL($sql_query);
        }


// -- Function Name : count_amount_of_searches
// -- Params : 
// -- Purpose : 
        public function count_amount_of_searches(){
            $sql_query = "SELECT count(id) as count FROM `searches`";
            $result =$this->runSQL($sql_query);
            $count = mysqli_fetch_array($result);
            return  $count;
        }


// -- Function Name : check_if_password_changed
// -- Params : $password
// -- Purpose : 
        public function check_if_password_changed($password){
            $sql_query = "SELECT count(id) as count FROM `users` where password='" . $password   ."' and id='" . $_SESSION["ID"] . "'";
            $result =$this->runSQL($sql_query);
            $count = mysqli_fetch_array($result);
            return  $count[0];
        }


// -- Function Name : runSQL
// -- Params : $sql_query
// -- Purpose : 
        public function runSQL($sql_query){
            return  mysqli_query($this->con,$sql_query);
        }

        

// -- Function Name : escape_string
// -- Params : $string
// -- Purpose : 
        public function escape_string($string){
            $escape_string = mysqli_real_escape_string($this->con, $string);
            return $escape_string;
        }

    }

    ?>