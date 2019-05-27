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
            return $this->sqlDate["profilePic"];
        }

        // Get Signin Date to Display
        public function getSignUpDate(){
            return $this->sqlDate["signUpDate"];
        }

        // Subscribers Function
        public function isSubscribedTo($userTo){
            $query = $this->con->prepare("SELECT * FROM subscribers WHERE userTo= :userTo AND userFrom= :userFrom");
            $query->bindParam(":userTo", $userTo);
            $query->bindParam(":userFrom",$username);

            $username = $this->getUsername();

            $query->execute();

            return $query->rowCount() > 0;
        }

        // get User Subscribers Count
        public function getSubscriberCount(){
            $query = $this->con->prepare("SELECT * FROM subscribers WHERE userTo= :userTo");
            $query->bindParam(":userTo", $username);

            $username = $this->getUsername();

            $query->execute();

            return $query->rowCount();
        }

    }

?>