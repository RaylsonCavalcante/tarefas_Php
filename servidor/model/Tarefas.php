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

                    //Array contendo os dados da tarefa
                    $arr = [$exibir->id,$exibir->titulo,$exibir->descricao];
                    
                    //Exibi cada Tarefa na Lista
                    echo "<div class='accordion-item'>
                            <h2 class=''style='display:flex;' id='flush-heading".$cont."'>
                                <button class='accordion-button collapsed' style='width:90%;' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapse".$cont."' aria-expanded='false' aria-controls='flush-collapseOne'>
                                <span class='badge bg-primary text-white'>".$cont."</span>
                                <span id='idTitulo'>$exibir->titulo</span>
                                </button>

                                <button class='btn' onclick='alterarTarefa(".json_encode($arr).")'>
                                <svg xmlns='http://www.w3.org/2000/svg' style='margin-top: -2%;' width='20' height='20' fill='currentColor' class='bi bi-pencil-square text-primary' viewBox='0 0 16 16'>
                                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                                </svg>
                                </button>

                                <button class='btn' onclick='excluirTarefa(".$exibir->id.")'>
                                
                                <svg xmlns='http://www.w3.org/2000/svg' style='margin-top:3%;' width='20' height='20' fill='currentColor' class='bi text-danger bi-trash-fill' viewBox='0 0 16 16'>
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

        //Alterar Tarefas
        public function alterar($id, $titulo, $descricao, $connect){

            $sql = mysqli_query($connect, "UPDATE tarefas SET titulo = '$titulo', descricao = '$descricao' WHERE id = '$id' ");
            
            return true;
        }

        //Excluir tarefa
        public function excluir($id, $connect){
            
            //Condição se for excluído ou não
            if($sql = mysqli_query($connect, "DELETE FROM tarefas WHERE id = '$id' ")){

                echo "Sim";
            }else{
                echo "Não";
            }

        }
    }
?>