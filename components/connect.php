<?php

    $db_name = //Acá va el nombre de tu BD.
    $db_user_name = //Acá va el nombre de usuario de la BD.
    $db_user_pass = //Acá va la contraseña de tu BD, si no tienes contraseña, deja vacio el espacio.
    

    $conn = new PDO($db_name, $db_user_name, $db_user_pass);

    function create_unique_id(){
        $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXY';
        $char_len = strlen($char);
        $rand_str = '';
        for ($i = 0; $i < 20; $i++){
            $rand_str .= $char[mt_rand(0, $char_len - 1)];
        }
        return $rand_str;
    }
?>
