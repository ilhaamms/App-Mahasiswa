<?php

namespace Helper{

    class InputHelper{

        // sengaja dibuat static function supaya bisa langsung manggil fungsinya
        public static function input(string $info): string{
            return readline($info);
        }

    }


}


?>