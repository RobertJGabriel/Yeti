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
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $website = $_POST['website'];
            $email = $_POST['email'];
            // Salted Hash
            $password = $_POST['password'];
            $salt = "nowelosdfjh1234";
            $password = $password.$salt;
            $password = sha1($password);

            $is_it_there =$this->database->check_if_account_exists($email);
            
            if ($is_it_there != '0' ){
                echo 'error';
            } else {
                $before = $this->database->count_amount_of_users();
                $this->database->register_account($firstName,$lastName,$website,$email,$password);
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
                    //    $_SESSION["companyId"] =  $row['companyId'];
                }

            }

        }

        public
        function get_amount_of_users(){
            return  $this->database->count_amount_of_users();
        }

        public
        function sign_in(){
            $email = $_POST['email'];
            $password = $_POST['password'];
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
            $password = $_POST["password"];
            $twitter =  $_POST["shareT"];
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