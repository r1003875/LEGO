<?php
    include_once("Db.php");
    class Order{
        private $order_date;
        private $status;
        private $user_id;
        private $address_id;

        /**
         * Get the value of order_date
         */ 
        public function getOrder_date()
        {
                return $this->order_date;
        }

        /**
         * Get the value of status
         */ 
        public function getStatus()
        {
                return $this->status;
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
                $this->user_id = $user_id;

                return $this;
        }

        /**
         * Get the value of address_id
         */ 
        public function getAddress_id()
        {
                return $this->address_id;
        }

        /**
         * Set the value of address_id
         *
         * @return  self
         */ 
        public function setAddress_id($address_id)
        {
                $this->address_id = $address_id;

                return $this;
        }

        public function save(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("insert into `order` (user_id, address_id) values (:user_id, :address_id)");
            $statement->bindValue(":user_id", $this->user_id);
            $statement->bindValue(":address_id", $this->address_id);
            $statement->execute();
            return $conn->lastInsertId();

        }

        public static function addProductsToOrder($order_id, $product_id){
            $conn = Db::getConnection();
            $statement = $conn->prepare("insert into order_products (order_id, products_id) values (:order_id, :product_id)");
            $statement->bindValue(":order_id", $order_id);
            $statement->bindValue(":product_id", $product_id);
            $statement->execute();
        }

        public static function getOrders($user_id){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from `order` where user_id = :user_id");
            $statement->bindValue(":user_id", $user_id);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getOrderProducts($order_id){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from order_products where order_id = :order_id");
            $statement->bindValue(":order_id", $order_id);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }