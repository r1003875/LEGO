<?php
    class Db{
        private static $conn = null;

        public static function getConnection(){
            if(self::$conn == null){
                $pathToSSL = __DIR__ . '/../cacert.pem';
                $options = [
                    PDO::MYSQL_ATTR_SSL_CA => $pathToSSL
                ];
                $host = getenv('DB_HOST');
                $db = getenv('DB_NAME');
                $user = getenv('DB_USER');
                $pass = getenv('DB_PASSWORD');
                self::$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass, $options);
                return self::$conn;
            }
            else{
                return self::$conn;
            }
        }
    }