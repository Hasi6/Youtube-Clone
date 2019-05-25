<?php
    class User{

        private $con;
        private $sqlDate;

        public function __construct($con, $username){
            $this->con = $con;

            $query = $this->con->prepare("SELECT * FROM users WHERE username=:un");

            $query->bindParam(":un", $username);
            $query->execute();

            $this->sqlDate = $query->fetch(PDO::FETCH_ASSOC);
        }

        public static function isLoggedIn() {
            return isset($_SESSION["userLoggedIn"]);
        }

        //Get Name to Display
        public function getUsername(){
            return $this->sqlDate["username"];
        }

        //Get Firstname to Display
        public function getFirstName(){
            return $this->sqlDate["firstName"];
        }

        //Get Lastname to Display
        public function getLastName(){
            return $this->sqlDate["lastName"];
        }

        //Get Email to Display
        public function getEmail(){
            return $this->sqlDate["email"];
        }

        //Get Profile Picture to Display
        public function getProfilePic(){
            return $this->sqlDate["ProfilePic"];
        }

        public function getSignUpDate(){
            return $this->sqlDate["signUpDate"];
        }

    }

?>