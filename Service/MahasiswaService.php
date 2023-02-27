<?php

// service ini adalah jembatan untuk repository
namespace Service{

    use Repository\MahasiswaRepository;
    use Model\Mahasiswa;
    use Helper\InputHelper;

    interface MahasiswaService{
        public function addMahasiswa(): void;
        public function removeMahasiswa(): void;
        public function findAllMahasiswa(): void;
        public function changeMahasiswa(): void;
        public function searchMahasiswa(): void;
    }

    class MahasiswaServiceImpl implements MahasiswaService{

        // pake tipe data interface Mahasiswa repository supaya bisa akses method yang ada didalam interface tersebut
        private MahasiswaRepository $mahasiswaRepository;

        public function __construct(MahasiswaRepository $mahasiswaRepository){
            $this->mahasiswaRepository = $mahasiswaRepository;
        }

        public function addMahasiswa(): void{
            $name   = InputHelper::input("Nama   : ");
            $addres = InputHelper::input("Addres : ");
            $email  = InputHelper::input("Email  : ");
            
            $mahasiswa = new Mahasiswa($name, $addres, $email); // semua data yang diinput ditampung didalam objek Mahasiswa

            echo "\nData Berhasil Diinput\n" . PHP_EOL;
            $question = InputHelper::input("Save Data (Y/N) ? ");
            if($question == "y" || $question == "Y"){
                $this->mahasiswaRepository->save($mahasiswa);
            }else{
                $this->mahasiswaRepository->notSave($mahasiswa);
            }

        }
        
        public function removeMahasiswa(): void{
            
            $name = InputHelper::input("Nama : ");

            $dataMhs = $this->mahasiswaRepository->findAll(); // ini adalah array yang didalamnya adalah data sebuah objek
            $succes = false;
            foreach($dataMhs as $mhs){ // mhs ini adalah sebuah objek
                if($name == $mhs->getName()){
                    $succes = true;
                    break;
                }
            }

            if($succes){
                echo "\nData Ditemukan" . PHP_EOL;
                echo "==============" . PHP_EOL;
                echo "Nama : " . $mhs->getName() . PHP_EOL;
    
                $question = InputHelper::input("Hapus Data (Y/N) ? ");
                if($question == "y" || $question == "Y"){
                    $this->mahasiswaRepository->remove($name);
                    echo "\nData Berhasil Dihapus" . PHP_EOL;
                }else{
                    echo "Hapus Data Dibatalkan" . PHP_EOL;
                }
            }else{
                echo "\nData Tidak Ditemukan" . PHP_EOL;
                $question = InputHelper::input("Coba Hapus Data Mahasiswa Lagi (Y/N) ? ");
                if($question == "y" || $question == "Y"){
                    $this->searchMahasiswa();
                }
            }

        }

        public function findAllMahasiswa(): void{

            $mahasiswa = $this->mahasiswaRepository->findAll();          
            foreach($mahasiswa as $key => $mhs){
                echo "Data ke-" . $key + 1 . PHP_EOL;
                echo "Nama   : " . $mhs->getName() . PHP_EOL;
                echo "Addres : " . $mhs->getAddres() . PHP_EOL;
                echo "Email : "  . $mhs->getEmail() . PHP_EOL;
                echo "=====================\n";
            }
        }

        public function changeMahasiswa(): void{
            $name = InputHelper::input("Nama : ");

            $dataMhs = $this->mahasiswaRepository->findAll();
            $succes = false;
            foreach($dataMhs as $mhs){
                if($name == $mhs->getName()){
                    $succes = true;
                    break;
                }
            }

            if($succes){
                echo "\nData Ditemukan" . PHP_EOL;
                echo "==============" . PHP_EOL;
                echo "Nama : " . $mhs->getName() . PHP_EOL;
    
                $question = InputHelper::input("Ubah Data (Y/N) ? ");
                if($question == "y" || $question == "Y"){
                    echo "\n";
                    $changeName = InputHelper::input("Nama Baru : ");
                    $this->mahasiswaRepository->change($changeName, $name);
                    
                    echo "\nData Berhasil Diubah" . PHP_EOL;
                    $question = InputHelper::input("Ubah Data Lagi (Y/N) ? ");
                    if($question == "y" || $question == "Y"){
                        $this->changeMahasiswa();
                    }else{
                        echo "Ubah Data Dibatalkan" . PHP_EOL;
                    }
                }else{
                    echo "Ubah Data Dibatalkan" . PHP_EOL;
                }
            }else{
                echo "\nData Tidak Ditemukan" . PHP_EOL;
                $question = InputHelper::input("Coba Ubah Data Mahasiswa Lagi (Y/N) ? ");
                if($question == "y" || $question == "Y"){
                    $this->searchMahasiswa();
                }
            }
        }

        public function searchMahasiswa(): void{

            echo "\n";
            $name = InputHelper::input("Nama Mahasiswa : ");
            $mahasiswa = $this->mahasiswaRepository->findAll();          
            
            $succes = false;
            foreach($mahasiswa as $mhs){
                if($name == $mhs->getName()){
                    $succes = true;
                    break;
                }
            }

            if($succes){
                echo "\nData Ditemukan" . PHP_EOL;
                echo "==============" . PHP_EOL;
                echo "Nama   : " . $mhs->getName() . PHP_EOL;
                echo "Addres : " . $mhs->getAddres() . PHP_EOL;
                echo "Email  : " . $mhs->getEmail() . PHP_EOL;
                $question = InputHelper::input("Cari Data Mahasiswa Lagi (Y/N) ? ");
                if($question == "y" || $question == "Y"){
                    $this->searchMahasiswa();
                }
            }else{
                echo "\nData Tidak Ditemukan" . PHP_EOL;
                $question = InputHelper::input("Cari Data Mahasiswa Lagi (Y/N) ? ");
                if($question == "y" || $question == "Y"){
                    $this->searchMahasiswa();
                }
            }
        }
        

    }

}


?>