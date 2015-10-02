<?php
    // -- Class Name : database
    // -- Purpose : To Connect and run sql querys to the database 
    // -- Created On : 21/03/2015
    
    class database{

        var $username = "admin1964";
        var $password= "Peanutbutter1964";
        var $host = "th2y25lz2e.database.windows.net,1433";
        var $database = "yeti";
        var $con;
        
        public
        function __construct()   {
            $this->con=mysqli_connect($this->host,$this->username,$this->password,$this->database);
            
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

        }

        public
        function __destruct(){
            mysqli_close($this->con);
        }

        public
        function sign_in($email,$password){
            $sql_query = "SELECT `id`,`firstName`,`lastName`,`website`,`email`,`password`, `twitter`,`companyId`,`salt` FROM `users` WHERE email ='" . $email . "' AND password ='" . $password ."'";
            return $this->runSQL($sql_query);
        }

        public
        function getsalt($email)        {
            $sql_query = "SELECT `salt` FROM `users` WHERE email ='" . $email . "'";
            $result =   $this->runSQL($sql_query);
            $displayAsString = mysqli_fetch_array($result);
            return  $displayAsString[0];
        }


           public
        function getCompanyByKey($key)        {
            $sql_query = "SELECT `companyId` FROM `users` WHERE salt ='" . $key . "'";
            $result =   $this->runSQL($sql_query);
            $displayAsString = mysqli_fetch_array($result);
            return  $displayAsString[0];
        }

        public
        function getsaltpassword($email)        {
            $sql_query = "SELECT `password` FROM `users` WHERE email ='" . $email . "'";
            $result =   $this->runSQL($sql_query);
            $displayAsString = mysqli_fetch_array($result);
            return  $displayAsString[0];
        }

        public
        function register_account($firstName,$lastName,$website,$email,$password,$salt,$companyId){
            $sql_query = "INSERT INTO `users`(`firstName`,`lastName`,`website`, `email`, `password`,`salt`,`companyId`) VALUES (
       '" . $firstName  ."','" . $lastName  ."','" . $website  ."','" . $email  ."','" . $password  ."','".  $salt ."','". $companyId .  "')";
            $this->runSQL($sql_query);
        }


public function importSearch($title,$description,$url_or_link,$information,$manualImported,$companyId){
     

     $sql_query = "INSERT INTO `files`(`title`,`description`,`url`, `information`, `manual`, `companyId`) VALUES (
       '" . $title  ."','" . $description  ."','" . $url_or_link  ."','". $information  ."','" . $manualImported  ."','" . $companyId  ."')";
            $this->runSQL($sql_query);


}



        public
        function getPopluarSearches(){
            $sql_query = "SELECT `search_term`,`userID`,`date`,`time`,`location` FROM `searches`  WHERE `companyId` = '" . $_SESSION["companyId"] .  "' GROUP BY search_term";
            return $this->runSQL($sql_query);
        }

        public
        function updateSettings($twitter,$gogoduck,$bing,$google){
            $sql_query = "UPDATE settings SET twitter='" . $twitter   ."'' ,gogoduck='".  $gogoduck .  "', bing='" . $bing  ."', google='" . $google ."' WHERE companyId=1";
            $this->runSQL($sql_query);
        }

        public
        function check_if_company_exists($companyName){
            $sql_query = "SELECT count(companyId)  FROM `company` where companyName='" . $companyName ."'";
            $result =   $this->runSQL($sql_query);
            $count = mysqli_fetch_array($result);
            return  $count[0];
        }

        public
        function createCompany($companyName){
            $sql_query = "  INSERT INTO `company`(`companyName`,`paided`,`plan`) 
                            VALUES ('" . $companyName  ."','0','0')";
            $this->runSQL($sql_query);
        }

        public
        function createCompanySettings($companyName){
            $sql_query = "  INSERT INTO `settings`(`companyId`) 
                            VALUES ('" . $this->getCompanyId($companyName)  ."')";
            $this->runSQL($sql_query);
        }

        public
        function getCompanyId($companyName){
            $sql_query = "SELECT companyId  FROM `company` where companyName='" . $companyName ."'";
            $result =   $this->runSQL($sql_query);
            $count = mysqli_fetch_array($result);
            return  $count[0];
        }

        public
        function delete_account($id){
            $sql_query = "DELETE FROM users WHERE id='" . $id ."'";
            $this->runSQL($sql_query);
        }

        public
        function update_account($firstName, $lastName, $companyName, $email){
            
        $sql;

        $sql = "UPDATE " .self::$users_table." SET ";
        $sql .= "email= '" . $database->escape_string($email ). "', ";
        $sql .= "$companyName = '" . $database->escape_string($companyName  ). "', ";
        $sql .= "firstName= '" . $database->escape_string($firstName ). "', ";
        $sql .= "lastName= '" . $database->escape_string( $lastName). "' ";
        $sql .= "WHERE website= '" . $database->escape_string($_SESSION["website"]). "' ";

        return $this->runSQL($sql);
        
        }

        public
        function count_amount_of_users(){
            $sql_query = "SELECT count(id) as count FROM `users`";
            $result =$this->runSQL($sql_query);
            $count = mysqli_fetch_array($result);
            return   $count[0];
        }

        public
        function check_if_account_exists($email){
            $sql_query = "SELECT count(id)  FROM `users` where email='" . $email ."'";
            $result =   $this->runSQL($sql_query);
            $count = mysqli_fetch_array($result);
            return  $count[0];
        }

        public
        function add_search($searchterm, $id){
            $sql_query = " INSERT INTO `searches`(`search_term`, `userID`, `date`, `time`) VALUES ('" .$searchterm ."','". $id ."','" . date("d-m-y") . "','" .   date("h:i:sa")."')";
            $this->runSQL($sql_query);
        }

        public
        function amount_of_searches(){
            $sql_query = "SELECT Distinct count(date) as Number , date 
                            FROM searches 
                            GROUP BY date";
            return  $this->runSQL($sql_query);
        }

        public
        function getSearch($companyId,$term){
         $sql_query = "SELECT `title`,`description`,`information`,`url`,`manual` FROM `files`  WHERE (`companyId` ='". $companyId .  "') AND (`title` LIKE  '" . $term  ."%')";
           return  $this->runSQL($sql_query);
            
        }


              public
        function count_amount_of_searches(){
            $sql_query = "SELECT count(id) as count FROM `searches`";
            $result =$this->runSQL($sql_query);
            $count = mysqli_fetch_array($result);
            return  $count;
        }


        public
        function check_if_password_changed($password){
            $sql_query = "SELECT count(id) as count FROM `users` where password='" . $password   ."' and id='" . $_SESSION["ID"] . "'";
            $result =$this->runSQL($sql_query);
            $count = mysqli_fetch_array($result);
            return  $count[0];
        }

        public
        function runSQL($sql_query){
            return  mysqli_query($this->con,$sql_query);
        }

    }

    ?>
