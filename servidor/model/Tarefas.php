<?php
    //Importa os arquivo para Conexão com o Banco De Dados
    include 'connect.php';
    
    //Cria a Class
    class Tarefas{

        //Atributos ou Variáveis de Classe
        public $titulo;
        public $descricao;

        //Salvar Tarefa
        public function registro($connect){

            //Adicionar ao Banco
            $sql = mysqli_query($connect, "INSERT INTO tarefas (titulo, descricao) VALUES ('$this->titulo', '$this->descricao')");

            return true;
        }

        //Exibir tarefas
        public function exibir($connect){

            //Recupera dados da tabela "tarefas"
            $sql = mysqli_query($connect, "SELECT * FROM tarefas ORDER BY titulo ASC");
            
            //Retorna número de items presentes
            $num = mysqli_num_rows($sql);
            
            //Condição se houver Items presentes ou não
            if($num > 0){

                //Variável contadora
                $cont = 1;
                
                //Exibir quantas Tarefas houver
                while($exibir = mysqli_fetch_object($sql)){
                    
                    //Exibi cada Tarefa na Lista
                    echo "<div class='accordion-item'>
                            <h2 class=''style='display:flex;' id='flush-heading".$cont."'>
                                <button class='accordion-button collapsed' style='width:90%;' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapse".$cont."' aria-expanded='false' aria-controls='flush-collapseOne'>
                                <span class='badge bg-primary text-white'>".$cont."</span>
                                <span id='idTitulo'>$exibir->titulo</span>
                                </button>
                                <button class='btn' onclick='excluirTarefa(".$exibir->id.")'>
                                
                                <svg xmlns='http://www.w3.org/2000/svg' style='margin-top:3%;' width='25' height='25' fill='currentColor' class='bi text-danger bi-trash-fill' viewBox='0 0 16 16'>
                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                </svg>
                                
                                </button>
                            </h2>
                            <div id='flush-collapse".$cont."' class='accordion-collapse collapse' aria-labelledby='flush-heading".$cont."' data-bs-parent='#lista'>
                                <div class='accordion-body'>".$exibir->descricao."</div>
                            </div>
                        </div>";

                        $cont++;
                }
            }else{

                echo "<p class='text-white'>Não há tarefas</p>";
            }
        }
    }
?>