<?php
    include_once("database.php");
    
    // -- Class Name : user
    // -- Purpose : 
    // -- Created On : 
    
    class user{
        var $database;
        public
        function __construct()   {
            $this->database =  new database();
        }

        public
        function logout(){
            session_unset();
            session_destroy();
            header("Location: /index.php");
            die();
        }

        public
        function createCompany($companyName){
            $exisit =    $this->database->check_if_company_exists($companyName);
            
            if ($exisit !== "1"){
                $this->database->createCompany($companyName);
                $this->database->createCompanySettings($companyName);
            } else            {
                echo 'error';
            }

        }

        public
        function register_account(){
            $firstName  =   filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
            $lastName   =   filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
            $website    =   filter_var($_POST['website'], FILTER_SANITIZE_STRING);
            $email      =   filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $companyName      =   filter_var($_POST['companyName'], FILTER_SANITIZE_STRING);
            $password   =   filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $this->createCompany($companyName);
            $companyId =  $this->database->getCompanyId($companyName);
            $is_it_there =$this->database->check_if_account_exists($email);
            
            if ($is_it_there != '0' ){
                echo 'error1';
            } else {
                $createSalt = $this->createSalt($email);
                $final_password = $this->encrypt_password($password,$createSalt);
                // Salted Hash
                $before = $this->database->count_amount_of_users();
                $this->database->register_account($firstName,$lastName,$website,$email,$final_password,$createSalt,$companyId);
                $after = $this->database->count_amount_of_users();
                $this->createFolder($website);
                if(($before + 1) == $after){
                    echo 'true';
                } else {
                    echo 'error2';
                }

            }

        }

        public
        function encrypt_password($password,$salt){
            $password = sha1($password.$salt);
            return $password;
        }

        
        function createSalt($email){
            $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
            $pass = array();
            //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1;
            //put the length -1 in cache
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }

            // $this->database->setSalt($email,implode($pass));
            return implode($pass);
            //turn the array into a string
        }

        
        function dectypt_password($email,$password){
            $saltfromdb =     $this->database->getsalt($email);
            $saltpassword =     $this->database->getsaltpassword($email);
            
            if($saltpassword  === sha1($password.$saltfromdb)){
                return $saltpassword;
            } else {
                echo 'false';
            }

        }

        public
        function sign_in(){
            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $truePassword = $this->dectypt_password($email,$password);
            $results =   $this->database->sign_in($email,$truePassword);
            $count = mysqli_num_rows($results);
            
            if ( $count != '1') {
                echo 'error';
            } else
            if( $count == '1') {
                echo 'true';
                $this->create_sessions($results);
            }

        }

        public
        function create_sessions($results){
            // session_start();
            $count = mysqli_num_rows($results);
            
            if($count===1){
                while($row = $results->fetch_assoc()){
                    $_SESSION["ID"] =  $row['id'];
                    $_SESSION["first_Name"] =  $row['firstName'];
                    $_SESSION["last_Name"] =  $row['lastName'];
                    $_SESSION["website"] =  $row['website'];
                    $_SESSION["email"] =  $row['email'];
                    $_SESSION["twitter"] =  $row['twitter'];
                    $_SESSION["password"] =  $row['password'];
                    $_SESSION["companyId"] =  $row['companyId'];
                    $_SESSION["apikey"] = $row['salt'];
                }

            }

        }

        

        public
        function get_amount_of_users(){
            return  $this->database->count_amount_of_users();
        }

        public
        function delete_account(){

        $id = $_SESSION["ID"];
        $this->database->delete_account($id);
        $this->logout();

        }

        public
        function update_account(){

        $firstName  =   filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
        $lastName   =   filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
        $email  =  filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        //print_r($email. " ". $lastName." ".$companyName. " ". $firstName. "<br>");

        $is_it_there =$this->database->check_if_account_exists($email);

        if($is_it_there != '0'){
           print_r("error");
        }else{

            $this->database->update_account($firstName, $lastName, $email);

        }

       
    }

        public
        function updateSearch_Settings(){
            $twitter = $this->null_check('twitters');
            $google = $this->null_check("googles");
            $bing = $this->null_check("bings");
            $gogoduck = $this->null_check("duckduckgos");
            $this->database->updateSettings($twitter,$gogoduck,$bing,$google);
        }

        public
        function null_check($postName){
            $temp = '';
            
            if("" !== trim($_POST[$postName])){
                return filter_var($_POST[$postName], FILTER_SANITIZE_STRING);
            } else {
                return 'no';
            }

        }

        public
        function createFolder($companyName){
            //    mkdir('installations/' . $companyName, 0700);
            //Creates Folders
        }

        public
        function view($view_name){
            include_once("application/views/" . $view_name . ".html");
        }

        public
        function updateTwitter_Session($twitter){
            $_SESSION["twitter"] =  $twitter;
        }

    }

    ?>