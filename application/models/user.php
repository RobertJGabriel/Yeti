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
            header("Location: http://localhost/yeti/");
            die();
        }

        public
        function register_account(){
            $firstName  =   filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
            $lastName   =   filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
            $website    =   filter_var($_POST['website'], FILTER_SANITIZE_STRING);
            $email      =   filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $password   =   filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            
            $final_password = $this->encrypt_password($password); // Salted Hash
            $is_it_there =$this->database->check_if_account_exists($email);
            
            if ($is_it_there != '0' ){
                echo 'error';
            } else {
                $before = $this->database->count_amount_of_users();
                $this->database->register_account($firstName,$lastName,$website,$email,$final_password);
                $after = $this->database->count_amount_of_users();
                $this->createFolder($website);
                
                if(($before + 1) == $after){
                    echo 'true';
                } else {
                    echo 'error';
                }

            }

        }

        public
        function encrypt_password($password){
            $salt = "nowelosdfjh1234";
            $password = sha1($password.$salt);
            return $password;
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
                }

            }

        }

        public
        function get_amount_of_users(){
            return  $this->database->count_amount_of_users();
        }

        public
        function sign_in(){
            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $results =   $this->database->sign_in($email,$password);
            $count = mysqli_num_rows($results);
            
            if ( $count != '1'){
                echo 'error';
            } else
            if( $count == '1'){
                echo 'true';
                $this->create_sessions($results);
            }

        }

        public
        function delete_account(){
            $email = $_SESSION["email"];
            $username = $_SESSION["NAME"];
            $this->database->delete_account($username,$email);
        }

        public
        function update_account(){
            $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
            $twitter =  filter_var($_POST["shareT"], FILTER_SANITIZE_STRING);
            $this->database->update_account($password,$twitter);
            $wasItChanged =  $this->database->check_if_password_changed($password);
            $this->updateTwitter_Session($_POST["shareT"]);
            
            if ($wasItChanged != '1' ){
                echo 'error';
            } else {
                echo 'passwordchanged';
            }

        }

        public
        function createFolder($companyName){
            mkdir('installations/' . $companyName, 0700);
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