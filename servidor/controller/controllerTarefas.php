<?php
    //Importa os arquivos da Classe e Conexão com o Banco De Dados
    require_once("../model/connect.php");
    require_once("../model/tarefas.php");

    //Aqui instaciamos um objeto da class Tarefas
    $tarefas = new Tarefas();
    
    //Varável para condicionar as funções específicas
    $ctrl = $_GET['ctrl'];

    //Salvar Tarefa
    if($ctrl == 'salvar'){

        //Armazena os valores obtidos
        $tarefas->titulo = $_POST['titulo'];
        $tarefas->descricao = $_POST['descricao'];

        //(Condição) Se caso for registrado ou não
        if($tarefas->registro($connect)){
            
            $stts = 1;
            $arr = [$stts];

            //Objeto => para representação JSON
            echo (json_encode($arr));

        }else{

            $stts = 0;
            $arr = [$stts];
            
            echo (json_encode($arr));
        }
    }

    //Exibir Tarefas
    if($ctrl == 'exibir'){

        $tarefas->exibir($connect);
    }

    //Alterar Tarefa
    if($ctrl == 'alterar'){

        //Pega o (id),(titulo),(descricao)
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];

        //Manda para ser alterado
        $tarefas->alterar($id, $titulo, $descricao, $connect);
    }

    //Excluir Tarefas
    if($ctrl == 'excluir'){
        
        //Pega o (id)
        $id = $_POST['id'];

        //Manda para ser Exluído
        $tarefas->excluir($id, $connect);
    }
?>