<?php
    class Db{
        private static $conn = null;

        public static function getConnection(){
            if(self::$conn == null){
                $pathToSSL = __DIR__ . '/../CA.pem';
                $options = [
                    PDO::MYSQL_ATTR_SSL_CA => $pathToSSL,
                ];
                $host = "legodb.mysql.database.azure.com";
                $db = "legoshop";
                $user = "legoadmin";
                $pass = "EHCSO&8DH28D";
                self::$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass, $options);
                return self::$conn;
            }
            else{
                return self::$conn;
            }
        }
    }