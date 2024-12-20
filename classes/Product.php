<?php
    include_once("Db.php");
    class Product {
        private $name;
        private $price;
        private $pieces_amount;
        private $min_age;
        private $rating;
        private $image;
        private $category_id;

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
                if(empty($price)){
                    throw new Exception("Enter a price.");
                }
                else if($price < 0){
                    throw new Exception("Price can't be negative.");
                }
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
                if(empty($pieces_amount)){
                    throw new Exception("Enter the amount of pieces.");
                }
                else if($pieces_amount < 0){
                    throw new Exception("Amount of pieces can't be negative.");
                }
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
                if(empty($min_age)){
                    throw new Exception("Enter the minimum age.");
                }
                else if($min_age < 0){
                    throw new Exception("Minimum age can't be negative.");
                }
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
                if(empty($rating)){
                    throw new Exception("Enter a rating.");
                }
                else if($rating < 0 || $rating > 5){
                    throw new Exception("Rating must be between 0 and 5.");
                }
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
                if(empty($image)){
                        throw new Exception("Please provide an image.");
                }
                $this->image = $image;

                return $this;
        }

        public function save(){
                $conn = Db::getConnection();
                $statement = $conn->prepare('INSERT INTO products (name, price, pieces_amount, min_age, rating, image, category_id) VALUES (:name, :price, :pieces_amount, :min_age, :rating, :image, :category_id)');
                $statement->bindValue(':name', $this->name);
                $statement->bindValue(':price', $this->price);
                $statement->bindValue(':pieces_amount', $this->pieces_amount);
                $statement->bindValue(':min_age', $this->min_age);
                $statement->bindValue(':rating', $this->rating);
                $statement->bindValue(':image', $this->image);
                $statement->bindValue(':category_id', $this->category_id);
                return $statement->execute();
        }
    
        public static function getAll(){
                $conn = Db::getConnection();
                $statement = $conn->query('SELECT * FROM products');
                return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getProductsByCategory($category){
                $conn = Db::getConnection();
                $statement = $conn->prepare('SELECT id FROM category WHERE name = :category');
                $statement->bindValue(':category', $category);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC)[0]['id'];
                $statement = $conn->prepare('SELECT * FROM products WHERE category_id = :category_id');
                $statement->bindValue(':category_id', $result);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * Get the value of category_id
         */ 
        public function getCategory_id()
        {
                return $this->category_id;
        }

        /**
         * Set the value of category_id
         *
         * @return  self
         */ 
        public function setCategory_id($category_id)
        {
                if(empty($category_id)){
                    throw new Exception("Please select a category.");
                }
                $this->category_id = $category_id;

                return $this;
        }

        public static function getProductById($id){
                $conn = Db::getConnection();
                $statement = $conn->prepare('SELECT * FROM products WHERE id = :id');
                $statement->bindValue(':id', $id);
                $statement->execute();
                return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public function update($id){
                $conn = Db::getConnection();
                $statement = $conn->prepare('UPDATE products SET name = :name, price = :price, pieces_amount = :pieces_amount, min_age = :min_age, rating = :rating, image = :image, category_id = :category_id WHERE id = :id');
                $statement->bindValue(':name', $this->name);
                $statement->bindValue(':price', $this->price);
                $statement->bindValue(':pieces_amount', $this->pieces_amount);
                $statement->bindValue(':min_age', $this->min_age);
                $statement->bindValue(':rating', $this->rating);
                $statement->bindValue(':image', $this->image);
                $statement->bindValue(':category_id', $this->category_id);
                $statement->bindValue(':id', $id);
                return $statement->execute();
        }

        public static function delete($id){
                $conn = Db::getConnection();
                $statement = $conn->prepare('DELETE FROM products WHERE id = :id');
                $statement->bindValue(':id', $id);
                return $statement->execute();
        }

    }