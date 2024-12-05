<?php
    class Customer extends User{
        private $credits;

        /**
         * Get the value of credits
         */ 
        public function getCredits()
        {
                return $this->credits;
        }

        /**
         * Set the value of credits
         *
         * @return  self
         */ 
        public function setCredits($credits)
        {
                if(empty($credits)){
                    throw new Exception("Enter a credit amount.");
                }
                else if($credits < 0){
                    throw new Exception("Credits can't be negative.");
                }
                $this->credits = $credits;

                return $this;
        }

        public function canAddProduct(){
            return false;
        }
    }