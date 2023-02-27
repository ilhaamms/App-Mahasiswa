<?php

require_once __DIR__ . "/Config/Database.php";
require_once __DIR__ . "/Model/Mahasiswa.php";
require_once __DIR__ . "/Repository/MahasiswaRepository.php";
require_once __DIR__ . "/Service/MahasiswaService.php";
require_once __DIR__ . "/View/ViewMahasiswa.php";
require_once __DIR__ . "/Helper/InputHelper.php";

use Config\Database;
use Model\Mahasiswa;
use Repository\MahasiswaRepositoryImpl;
use Service\MahasiswaServiceImpl;
use View\ViewMahasiswa;

$connection              = Database::getConnection();
$mahasiswaRepositoryImpl = new MahasiswaRepositoryImpl($connection);
$mahasiswaServiceImpl    = new MahasiswaServiceImpl($mahasiswaRepositoryImpl);
$ViewMahasiswa           = new ViewMahasiswa($mahasiswaServiceImpl);

$ViewMahasiswa->menu();

?>