<?php
    class Customer extends User{
        private $credtits;

        /**
         * Get the value of credtits
         */ 
        public function getCredtits()
        {
                return $this->credtits;
        }

        /**
         * Set the value of credtits
         *
         * @return  self
         */ 
        public function setCredtits($credtits)
        {
                $this->credtits = $credtits;

                return $this;
        }

        public function canAddProduct(){
            return false;
        }
    }