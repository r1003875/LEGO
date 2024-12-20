<?php
    include_once("Db.php");
    abstract class User {
        protected $firstname;
        protected $lastname;
        protected $email;
        protected $password;

        /**
         * Get the value of firstname
         */ 
        public function getFirstname()
        {
                return $this->firstname;
        }

        /**
         * Set the value of firstname
         *
         * @return  self
         */ 
        public function setFirstname($firstname)
        {
                if(empty($firstname)){
                        throw new Exception("Please enter your firstname.");
                }
                $this->firstname = $firstname;

                return $this;
        }

        /**
         * Get the value of lastname
         */ 
        public function getLastname()
        {
                return $this->lastname;
        }

        /**
         * Set the value of lastname
         *
         * @return  self
         */ 
        public function setLastname($lastname)
        {
                if(empty($lastname)){
                        throw new Exception("Please enter your lastname.");
                }
                $this->lastname = $lastname;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                if(empty($email)){
                        throw new Exception("Please enter a valid email.");
                }
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                if(empty($password)){
                        throw new Exception("Please enter a password.");
                }
                $options = [
                        'cost' => 15,
                ];
                $hash = password_hash($password, PASSWORD_DEFAULT, $options);
                $this->password = $hash;
                return $this;
        }

        public function save(){
                $conn = Db::getConnection();
                $statement = $conn->prepare('INSERT INTO user (first_name, last_name, email, password) VALUES (:firstname, :lastname, :email, :password)');
                $statement->bindValue(":firstname", $this->firstname);
                $statement->bindValue(":lastname", $this->lastname);
                $statement->bindValue(":email", $this->email);
                $statement->bindValue(":password", $this->password);
                return $statement->execute();
        }

        public static function getUser($email){
                $conn = Db::getConnection();
                $statement = $conn->prepare('SELECT * FROM user WHERE email = :email');
                $statement->bindValue(":email", $email);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);

        }

        public function updatePassword($email){
                $conn = Db::getConnection();
                $statement = $conn->prepare('UPDATE user SET password = :password WHERE email = :email');
                $statement->bindValue(":password", $this->password);
                $statement->bindValue(":email", $email);
                return $statement->execute();
        }
    }