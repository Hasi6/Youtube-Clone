<?php
    class User{

        private $con;
        private $sqlDate;

        public function __construct($con, $username){
            $this->con = $con;
        }
    }

?>