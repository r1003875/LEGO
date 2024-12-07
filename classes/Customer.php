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

        public static function updateBalance($new_balance){
            $conn = Db::getConnection();
            $statement = $conn->prepare("UPDATE user SET credits = :credits WHERE email = :email");
            $statement->bindValue(":credits", $new_balance);
            $statement->bindValue(":email", $_SESSION['email']);
            $statement->execute();
        }

        public static function setAddress($address_id){
            $conn = Db::getConnection();
            $statement = $conn->prepare("UPDATE user SET address_id = :address_id WHERE email = :email");
            $statement->bindValue(":address_id", $address_id);
            $statement->bindValue(":email", $_SESSION['email']);
            $statement->execute();
        }
    }