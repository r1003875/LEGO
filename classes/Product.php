<?php
    include_once("Db.php");
    class Product {
        private $name;
        private $price;
        private $pieces_amount;
        private $min_age;
        private $rating;
        private $image;

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                if(empty($name)){
                    throw new Exception("Enter a product name.");
                }
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of price
         */ 
        public function getPrice()
        {
                return $this->price;
        }

        /**
         * Set the value of price
         *
         * @return  self
         */ 
        public function setPrice($price)
        {
                $this->price = $price;

                return $this;
        }

        /**
         * Get the value of pieces_amount
         */ 
        public function getPieces_amount()
        {
                return $this->pieces_amount;
        }

        /**
         * Set the value of pieces_amount
         *
         * @return  self
         */ 
        public function setPieces_amount($pieces_amount)
        {
                $this->pieces_amount = $pieces_amount;

                return $this;
        }

        /**
         * Get the value of min_age
         */ 
        public function getMin_age()
        {
                return $this->min_age;
        }

        /**
         * Set the value of min_age
         *
         * @return  self
         */ 
        public function setMin_age($min_age)
        {
                $this->min_age = $min_age;

                return $this;
        }

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
                $this->rating = $rating;

                return $this;
        }

        /**
         * Get the value of image
         */ 
        public function getImage()
        {
                return $this->image;
        }

        /**
         * Set the value of image
         *
         * @return  self
         */ 
        public function setImage($image)
        {
                $this->image = $image;

                return $this;
        }

        public function save(){
                $conn = Db::getConnection();
                $statement = $conn->prepare('INSERT INTO products (name, price, pieces_amount, min_age, rating, image) VALUES (:name, :price, :pieces_amount, :min_age, :rating, :image)');
                $statement->bindValue(':name', $this->name);
                $statement->bindValue(':price', $this->price);
                $statement->bindValue(':pieces_amount', $this->pieces_amount);
                $statement->bindValue(':min_age', $this->min_age);
                $statement->bindValue(':rating', $this->rating);
                $statement->bindValue(':image', $this->image);
                return $statement->execute();
        }
    
        public static function getAll(){
                $conn = Db::getConnection();
                $statement = $conn->query('SELECT * FROM products');
                return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }