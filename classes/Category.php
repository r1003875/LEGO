<?php 
    include_once("Db.php");

    class Category{
        private $name;

        public static function getAll(){
            $conn = Db::getConnection();
            $statement = $conn->prepare('SELECT name FROM category');
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $categories = ["all"];
            foreach($result as $r){
                array_push($categories, $r['name']);
            }
            return $categories;
        }

        public function save(){
            $conn = Db::getConnection();
            $statement = $conn->prepare('INSERT INTO category (name) VALUES (:name)');
            $statement->bindValue(":name", $this->name);
            return $statement->execute();
        }

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
                $this->name = $name;

                return $this;
        }
    }

