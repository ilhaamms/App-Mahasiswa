<?php

namespace View{

    use Service\MahasiswaService;

    class ViewMahasiswa{

        // pake tipe data interface Mahasiswa service supaya bisa akses method yang ada didalam interface tersebut
        private MahasiswaService $mahasiswaService;

        public function __construct(MahasiswaService $mahasiswaService){
            $this->mahasiswaService = $mahasiswaService;
        }

        public function menu(){
            while(true){

                $this->findAllMahasiswa();

                echo "Menu Mahasiswa" . PHP_EOL;
                echo "[1] Add Data Mahasiswa" . PHP_EOL;
                echo "[2] Remove Data Mahasiswa" . PHP_EOL;
                echo "[3] Change Data Mahasiswa" . PHP_EOL;
                echo "[4] Search Mahasiswa\n" . PHP_EOL;
    
                $menu = readline("[-] Menu Pilihan : ");
                if($menu == 1){
                    $this->addMahasiswa();
                }elseif($menu == 2){
                    $this->removeMahasiswa();
                }elseif($menu == 3){
                    $this->changeMahasiswa();
                }else if($menu == 4){
                    $this->searchMahasiswa();
                }else{
                    echo "Menu Tidak Ada" . PHP_EOL;
                }
            }
        }

        public function addMahasiswa(){
            echo "\nAdd Data Mahasiswa" . PHP_EOL;
            echo "==================" . PHP_EOL;
            $this->mahasiswaService->addMahasiswa();
        }

        public function removeMahasiswa(){
            echo "\nRemove Data Mahasiswa" . PHP_EOL;
            echo "=======================" . PHP_EOL;
            $this->mahasiswaService->removeMahasiswa();
        }
        
        public function findAllMahasiswa(){
            echo "Data Mahasiswa" . PHP_EOL;
            echo "====================" . PHP_EOL;
            $this->mahasiswaService->findAllMahasiswa();
        }

        public function changeMahasiswa(){
            echo "\nChange Data Mahasiswa" . PHP_EOL;
            echo "=====================" . PHP_EOL;
            $this->mahasiswaService->changeMahasiswa();
        }

        public function searchMahasiswa(){
            echo "\nSearch Data Mahasiswa" . PHP_EOL;
            echo "=====================" . PHP_EOL;
            $this->mahasiswaService->searchMahasiswa();
        }


    }

}


?>