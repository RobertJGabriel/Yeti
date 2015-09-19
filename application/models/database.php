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
            $sql_query = "SELECT `id`,`firstName`,`lastName`,`website`,`email`,`password`, `twitter`,`companyId` FROM `users` WHERE email ='" . $email . "' AND password ='" . $password ."'";
            return $this->runSQL($sql_query);
        }

        public
        function register_account($firstName,$lastName,$website,$email,$password){
            

            $sql_query = "INSERT INTO `users`(`firstName`,`lastName`,`website`, `email`, `password`) VALUES (
       '" . $firstName  ."','" . $lastName  ."','" . $website  ."','" . $email  ."','" . $password  ."')";
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
        function delete_account($username,$email){
            $sql_query = "DELETE FROM users WHERE name='" . $username . "' AND email='" . $email ."'";
            $this->runSQL($sql_query);
        }

        public
        function update_account($password,$twitter){
            $sql_query = "UPDATE users SET password='" . $password   ."' ,twitter='".  $twitter .  "' WHERE id='" . $_SESSION["ID"] . "'";
            $this->runSQL($sql_query);
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
        function count_amount_of_searches(){
            $sql_query = "SELECT count(id) as count FROM `searches`";
            $result =$this->runSQL($sql_query);
            $count = mysqli_fetch_array($result);
            return  $count[0];
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