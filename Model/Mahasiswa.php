<?php

namespace Model{

    class Mahasiswa{

        // ini sengaja bisa null, karna kalau engga di assign constructnya tinggal kita assign null aja
        private ?string $name;
        private ?string $addres;
        private ?string $email;

        public function __construct(?string $name = null, ?string $addres = null, ?string $email = null){
            $this->name   = $name;
            $this->addres = $addres;
            $this->email  = $email;
        }

        // getter dan setter karena propertiesnya modifiernya private
        public function getName(): ?string{
            return $this->name;
        }

        public function setName($name): void{
            $this->name = $name;
        }

        public function getAddres(): ?string{
            return $this->addres;
        }

        public function setAddres($addres): void{
            $this->addres = $addres;
        }

        public function getEmail(): ?string{
            return $this->email;
        }

        public function setEmail($email): void{
            $this->email = $email;
        }

    }
}


?>