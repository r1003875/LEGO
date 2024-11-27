<?php
    include_once("Db.php");
    class Review{
        private $rating;
        private $comment;
        private $product_id;
        private $user_id;
        private $date;

        

        /**
         * Get the value of rating
         */ 
        public function getRating()
        {
                return $this->rating;
        }

        /**
         * Set the value of rating
         *
         * @return  self
         */ 
        public function setRating($rating)
        {
                if(empty($rating)){
                    throw new Exception("Something went wrong. Please try again later.");
                }
                $this->rating = $rating;

                return $this;
        }

        /**
         * Get the value of comment
         */ 
        public function getComment()
        {
                return $this->comment;
        }

        /**
         * Set the value of comment
         *
         * @return  self
         */ 
        public function setComment($comment)
        {
                if(empty($comment)){
                    throw new Exception("We really appreciate your feedback. Please enter a comment.");
                }
                $this->comment = $comment;

                return $this;
        }

        /**
         * Get the value of product_id
         */ 
        public function getProduct_id()
        {
                return $this->product_id;
        }

        /**
         * Set the value of product_id
         *
         * @return  self
         */ 
        public function setProduct_id($product_id)
        {
                if(empty($product_id)){
                    throw new Exception("Something went wrong. Please try again later.");
                }
                $this->product_id = $product_id;

                return $this;
        }

        /**
         * Get the value of user_id
         */ 
        public function getUser_id()
        {
                return $this->user_id;
        }

        /**
         * Set the value of user_id
         *
         * @return  self
         */ 
        public function setUser_id($user_id)
        {
                if(empty($user_id)){
                    throw new Exception("Something went wrong. Please try again later.");
                }
                $this->user_id = $user_id;

                return $this;
        }

        //save review in database
        public function save(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("INSERT INTO review (rating, comment, product_id, user_id) VALUES (:rating, :comment, :product_id, :user_id)");
            $statement->bindValue(":rating", $this->rating);
            $statement->bindValue(":comment", $this->comment);
            $statement->bindValue(":product_id", $this->product_id);
            $statement->bindValue(":user_id", $this->user_id);
            $result = $statement->execute();
            return $result;
        }


        /**
         * Get the value of date
         */ 
        public function getDate()
        {
                return $this->date;
        }

        /**
         * Set the value of date
         *
         * @return  self
         */ 
        public function setDate()
        {
                $this->date = date("d-m-Y");

                return $this;
        }

        public static function getUserById($id){
                $conn = Db::getConnection();
                $statement = $conn->prepare("SELECT * FROM user WHERE id = :id");
                $statement->bindValue(":id", $id);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $name = $result['first_name']." ".$result['last_name'];
                return $name;
        }

        public static function getAll($id){
                $conn = Db::getConnection();
                $statement = $conn->query("SELECT * FROM review WHERE product_id = $id");
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $result;
        }
    }