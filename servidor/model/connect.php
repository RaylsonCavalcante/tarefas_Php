<?php
    //(CORS)
    //Compartilhamento de recursos de origens diferentes. 
    //Necessário.
    header('Access-Control-Allow-Origin: *');


    $server = 'localhost';  //Servidor
    $user   = 'root';       //Usuário
    $pass   = '';           //Senha
    $bd     = 'tarefas';    //Banco

    //Conexão com o Banco de Dados
    $connect = mysqli_connect($server, $user, $pass, $bd);
?>