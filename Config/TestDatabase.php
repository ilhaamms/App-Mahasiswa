<?php

require_once __DIR__ . "/Database.php";

use Config\Database;

$connection = Database::getConnection();
echo "sukses Connect Database App Mahasiswa" . PHP_EOL;

?>