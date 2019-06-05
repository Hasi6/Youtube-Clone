<?php
    class Accounts{

        private $con;
        private $errorArray = array();

        public function __construct($con){
            $this->con = $con;
        }

    public function login($un, $ps){
        $ps = hash("sha512", $ps);

        $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:ps");
        $query->bindParam(":un", $un);
        $query->bindParam(":ps", $ps);

        $query->execute();

        if($query->rowCount() == 1 ){
            return true;
        }
        else{
            array_push($this->errorArray, Constance::$login);
            return false;
        }
    }

    public function register($fn, $ln, $un, $em, $em2, $ps, $ps2){
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUserName($un);
        $this->validateEmail($em, $em2);
        $this->validatePassword($ps, $ps2);

        if(empty($this->errorArray)){
            return $this->insertUserDetails($fn,$ln,$un,$em,$ps);
        }
        else{
            return false;
        }
    }

    // Update user details
    public function updateDetails($fn, $ln, $em, $un){
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateNewEmail($em, $un);

        if(empty($this->errorArray)){
            //Update Details

            $query = $this->con->prepare("UPDATE users SET firstname=:fn, lastname=:ln, email=:em WHERE username=:un");
            $query->bindParam(":fn", $fn);
            $query->bindParam(":ln", $ln);
            $query->bindParam(":em", $em);
            $query->bindParam(":un", $un);

            return $query->execute();
        }
        else{
            return false;
        }
    }

    // Insert User details to the database and password Hashing
    public function insertUserDetails($fn, $ln,$un,$em,$ps){

        // Password Hashing
        $ps = hash("sha512", $ps);

        // Insert the details to database
        $profilePic = "assets/images/icons/profile.png";

        $query = $this->con->prepare("INSERT INTO users (firstName,lastName,username,email,password,profilePic) VALUES (:fn,:ln,:un,:em,:ps,:pp)");
        $query->bindParam(":fn", $fn);
        $query->bindParam(":ln", $ln);
        $query->bindParam(":un", $un);
        $query->bindParam(":em", $em);
        $query->bindParam(":ps", $ps);
        $query->bindParam(":pp", $profilePic);

        return $query->execute();
    }

    private function validateFirstName($fn){

        // check the length of the string and if there is a any issue the issue push to the errorArray and the messages is in Constans class
        if(strlen($fn) < 2 || strlen($fn) > 25 ){
            array_push($this->errorArray,Constance::$firstNameCharacters);
        }
    }

    private function validateLastName($ln){

        // check the length of the string and if there is a any issue the issue push to the errorArray and the messages is in Constans class
        if(strlen($ln) < 2 || strlen($ln) > 25 ){
            array_push($this->errorArray,Constance::$lastNameCharacters);
        }
    }

    private function validateUserName($un){

        // check the length of the string and if there is a any issue the issue push to the errorArray and the messages is in Constans class
        if(strlen($un) < 5 || strlen($un) > 25 ){
            array_push($this->errorArray,Constance::$usernameCharacters);
            return;
        }
        // Check if username is already exists
        $query = $this->con->prepare("SELECT email FROM users WHERE username=:un");
        $query->bindParam(":un", $un);
        $query->execute();

        if($query->rowCount() != 0){
            array_push($this->errorArray,Constance::$usernameAlreadyHave);
        }
    }

    private function validateEmail($em,$em2){

        // check the length of the string and if there is a any issue the issue push to the errorArray and the messages is in Constans class
        if($em != $em2){
            array_push($this->errorArray,Constance::$emailMacthed);
            return;
        }

        if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
            array_push($this->errorArray,Constance::$emailValid);
            return;
        }
        // Check if username is already exists
        $query = $this->con->prepare("SELECT username FROM users WHERE email=:em");
        $query->bindParam(":em", $em);
        $query->execute();

        if($query->rowCount() != 0){
            array_push($this->errorArray,Constance::$emailAlreadyHave);
        }
    }

    private function validateNewEmail($em,$un){


        if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
            array_push($this->errorArray,Constance::$emailValid);
            return;
        }
        // Check if username is already exists
        $query = $this->con->prepare("SELECT username FROM users WHERE email=:em AND username != :un");
        $query->bindParam(":em", $em);
        $query->bindParam(":un", $un);
        $query->execute();

        if($query->rowCount() != 0){
            array_push($this->errorArray,Constance::$emailAlreadyHave);
        }
    }

    private function validatePassword($ps,$ps2){

        // check the length of the string and if there is a any issue the issue push to the errorArray and the messages is in Constans class
        if($ps != $ps2){
            array_push($this->errorArray,Constance::$passwordMacthed);
            return;
        }
        if(strlen($ps) < 8 || strlen($ps) > 20 ){
            array_push($this->errorArray,Constance::$passwordLenght);
            return;
        }
        if(preg_match("/[^A-Za-z0-9]/", $ps)){
            array_push($this->errorArray,Constance::$passwordValid);
            return;
        }

        
    }

    public function getError($error){
        if(in_array($error, $this->errorArray)){
            return "<span class='errorMessage'>$error</span>";
        }
    }

    public function getFirstError(){
        if(!empty($this->errorArray)){
            return $this->errorArray[0];
        }
        else{
            return "";
        }
    }

}

?>