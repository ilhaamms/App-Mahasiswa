<?php

namespace Config{

    class Database{

        // ini adalah class \PDO untuk membuat sebuah koneksi ke database
        public static function getConnection(): \PDO{
            $host = "localhost"; // host default laptop sendiri emang localhost
            $port = 3306; // port default laptop sendiri emang 3306
            $database = "app_mahasiswa"; // target database
            $username = "root"; // default username laptop sendiri emang root
            $password = "";

            // ini cara konek ke databasenya
            return new \PDO("mysql:host=$host:$port;dbname=$database", $username, $password);
        }

    }

}


?>