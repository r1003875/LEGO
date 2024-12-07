<?php
    include_once("Db.php");
    class Address{
        private $street;
        private $housenumber;
        private $city;
        private $country;

        

        /**
         * Get the value of street
         */ 
        public function getStreet()
        {
                return $this->street;
        }

        /**
         * Set the value of street
         *
         * @return  self
         */ 
        public function setStreet($street)
        {
                if(empty($street)){
                    throw new Exception("Please enter your street.");
                }
                $this->street = $street;

                return $this;
        }

        /**
         * Get the value of housenumber
         */ 
        public function getHousenumber()
        {
                return $this->housenumber;
        }

        /**
         * Set the value of housenumber
         *
         * @return  self
         */ 
        public function setHousenumber($housenumber)
        {
                if(empty($housenumber)){
                    throw new Exception("Please enter your housenumber.");
                }
                $this->housenumber = $housenumber;

                return $this;
        }

        /**
         * Get the value of city
         */ 
        public function getCity()
        {
                return $this->city;
        }

        /**
         * Set the value of city
         *
         * @return  self
         */ 
        public function setCity($city)
        {
                if(empty($city)){
                    throw new Exception("Please enter your city.");
                }
                $this->city = $city;

                return $this;
        }

        /**
         * Get the value of country
         */ 
        public function getCountry()
        {
                return $this->country;
        }

        /**
         * Set the value of country
         *
         * @return  self
         */ 
        public function setCountry($country)
        {
                if(empty($country)){
                    throw new Exception("Please enter your country.");
                }
                $this->country = $country;

                return $this;
        }

        public function save(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("insert into address (street, housenumber, city, country) values (:street, :housenumber, :city, :country)");
            $statement->bindValue(":street", $this->street);
            $statement->bindValue(":housenumber", $this->housenumber);
            $statement->bindValue(":city", $this->city);
            $statement->bindValue(":country", $this->country);
            return $statement->execute();
            
        }

        public static function getAddressId($street, $housenumber, $city, $country){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select id from address where street = :street and housenumber = :housenumber and city = :city and country = :country");
            $statement->bindValue(":street", $street);
            $statement->bindValue(":housenumber", $housenumber);
            $statement->bindValue(":city", $city);
            $statement->bindValue(":country", $country);
            $statement->execute();
            $id = $statement->fetch();
            return $id['id'];
        }

        public function checkAddress($street, $housenumber, $city, $country){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from address where street = :street and housenumber = :housenumber and city = :city and country = :country");
            $statement->bindValue(":street", $street);
            $statement->bindValue(":housenumber", $housenumber);
            $statement->bindValue(":city", $city);
            $statement->bindValue(":country", $country);
            $statement->execute();
            $address = $statement->fetch();
            if($address){
                return $address['id'];
            }
            else{
                return false;
            }
        }

        public static function getAddressById($id){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from address where id = :id");
            $statement->bindValue(":id", $id);
            $statement->execute();
            $address = $statement->fetch();
            return $address;
        }
    };