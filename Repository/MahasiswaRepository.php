<?php

// repository ini adalah business logicnya atau query
namespace Repository{

    use Model\Mahasiswa;

    interface MahasiswaRepository{
        // pake tipe data class Mahasiswa, maka nanti pas isi parameternya wajib sudah menjadi objek
        public function save(Mahasiswa $mahasiswa): void; 
        public function notSave(Mahasiswa $mahasiswa): void;
        public function remove(string $name): void; // hapus beradasarkan nama
        public function findAll(): array; // mencari semua data yang ada di database
        public function change(string $changeName, string $name): void; // ubah berdasarkan nama, dan cari data berdasarkan nama
    }

    class MahasiswaRepositoryImpl implements MahasiswaRepository{

        private \PDO $connection; // ini pake tipe data PDO karena di parameter konstruktor mau diisi sama koneksi ke database

        public function __construct(\PDO $connection){
            $this->connection = $connection;
        }

        public function save(Mahasiswa $mahasiswa): void{
            
            $this->connection->beginTransaction(); // begin transaction supaya engga auto commit

            $sql = "INSERT INTO mahasiswa(name, addres, email) VALUES(?, ?, ?)";
            $statement = $this->connection->prepare($sql); // pake prepare karena sqlnya inputan dari user
            $statement->execute([$mahasiswa->getName(), $mahasiswa->getAddres(), $mahasiswa->getEmail()]); // mahasiswa ini adalah sudah
             // objek karena di parameter save tipe datanya adalah class, menggunakan get karena datanya sudah diinput 
            
            $this->connection->commit(); // commit atau simpan data kedalam database

            echo "Data Saved" . PHP_EOL;
            // $this->connection = null; harusnya bisa dikasih null untuk nutup koneksinya
        }

        public function notSave(Mahasiswa $mahasiswa): void{

            $this->connection->beginTransaction();

            $sql = "INSERT INTO mahasiswa(name, addres, email) VALUES(?, ?, ?)";
            $statement = $this->connection->prepare($sql); 
            $statement->execute([$mahasiswa->getName(), $mahasiswa->getAddres(), $mahasiswa->getEmail()]);

            $this->connection->rollback(); // rollback, atau tidak commit(simpan data) ke database
            echo "Data Not Save";
            // $this->connection = null; harusnya bisa dikasih null untuk nutup koneksinya
        }

        public function remove(string $name): void{

            $sql = "DELETE FROM mahasiswa WHERE name = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$name]);

        }

        public function findAll(): array{

            $sql = "SELECT * FROM mahasiswa";
            $statement = $this->connection->query($sql); // menggunakan query karena tidak ada inputan dari user

            $dataMhs = [];

            foreach($statement as $row){
                $mahasiswa = new Mahasiswa(); // membuat sebuah objek mahasiswa
                $mahasiswa->setName($row["name"]); // kemudian kita set name, addres, dan email yang ada di properties objek mahasiswa
                $mahasiswa->setAddres($row["addres"]);
                $mahasiswa->setEmail($row["email"]);
                
                $dataMhs[] = $mahasiswa; // setelah di set name, addres, dan emailnya, maka objeknya kita masukan kedalam sebuah array

            }

            return $dataMhs;
        }

        public function change(string $changeName, string $name): void{

            // set ini adalah namanya diubah menjadi apa, dan kondisi kolom nama mana yang mau diubah
            $sql = "UPDATE  mahasiswa SET name = ? WHERE name = ?"; 
            $statement = $this->connection->prepare($sql);
            $statement->execute([$changeName, $name]);
            
        }

    }


}


?>