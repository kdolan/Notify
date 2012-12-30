<?php
    class User
    {
        private $username;
        private $phoneNumber;
        private $carrier;
        private $contactMethod; //Contact method for current service only.
        
        public function __construct($username, $phoneNumber, $carrier, $contactMethod) 
        {
            $this->username = $username;
            $this->phoneNumber = $phoneNumber;
            $this->carrier = $carrier;
            $this->contactMethod = $contactMethod;
        }
        
        public function getUsername()
        {
            return $this->username; 
        }
        
        public function getPhoneNumber()
        {
            return $this->phoneNumber;
        }
        
        public function getCarrier()
        {
            return $this->carrier;
        }
        
        public function getContactMethod()
        {
            return $this->contactMethod;
        }
    }
?>