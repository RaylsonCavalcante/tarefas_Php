document.addEventListener('deviceready', onDeviceReady, false);

function onDeviceReady() {
    // Cordova is now initialized. Have fun!

    console.log('Running cordova-' + cordova.platformId + '@' + cordova.version);
    document.getElementById('deviceready').classList.add('ready');
}




                                                //FUNÇÕES JQUERY

//IR PARA TELA LISTA DE TAREFAS
function TelaLista() {

   	$(".divLista").addClass("mostraTelaLista");
   	
   	$(".divNovaTarefa").addClass("esconderTelaNovaTarefa");

	window.history.pushState({page:1}, 'TelaLista', 'Lista');

    $(".btn-lista").addClass("display");
    $(".btn-voltar").removeClass("display");
}

//VOLTAR PARA TELA NOVA TAREFA (Botao do Aplicativo)
function Voltar(){

    $(".divLista").removeClass("mostraTelaLista");	   	

    $(".divNovaTarefa").removeClass("esconderTelaNovaTarefa");
	
    $(".btn-lista").removeClass("display");
    $(".btn-voltar").addClass("display");

    history.go(-1);
};

//VOLTAR PARA TELA NOVA TAREFA (Botao de voltar do Telefone)
window.addEventListener('popstate', e => {
    
    $(".divLista").removeClass("mostraTelaLista");	   	

    $(".divNovaTarefa").removeClass("esconderTelaNovaTarefa");

    $(".btn-lista").removeClass("display");
    $(".btn-voltar").addClass("display");
    
});


                                            //ADICIONAR TAREFAS

//Salvar Tarefa
$(document).ready(function(){
    $(".btn-adicionar").click(function(e){
        //Evita que a página atualize
        e.preventDefault();
        
        //Verificação de campos Vazios
        if($("#titulo").val() === "" || $("#descricao").val() === ""){
            
            //Alerta
            Swal.fire({
                icon: 'info',
                text: 'Preencha os campos!',
            });
        }else{
            //Comucicação com o Servidor
            $.ajax({
                type: 'POST',
                //Não esqueça de verificar o Ip de sua máquina
                url: "http://192.168.0.14/servidor/controller/controllerTarefas.php?ctrl=salvar",
                async: true,
                dataType: 'json',
                data:{
                    titulo: $("#titulo").val(),
                    descricao: $("#descricao").val(),
                },
                //Se a conexão for bem sucedida
                success: function(data){
                    //(Variável) Para pegar o resultado retornado do servidor
                    var stts = data[0];
                    
                    //(Condição) Verifica se a ação foi ou não realizada com sucesso
                    if(stts === 1){
                        Swal.fire({
                            icon: 'success',
                            text: 'Tarefa Salva!',
                        });

                        //Atualiza Lista de Tarefas
                        ExibirTarefas();
                        
                        //Esvazia campos
                        $(".campos").val("");
                    }else{
                        Swal.fire({
                            icon: 'error',
                            text: 'Tarefa Não Salva!',
                        });
                    }
                },
                //Se a conexão não for bem sucedida
                error: function(data){
                    Swal.fire({
                        icon: 'error',
                        text: 'Erro ao tentar Conexão!',
                    });
                }
            });
        }
    });
});

//Exibir Tarefas
function ExibirTarefas(){

    //Comucicação com o Servidor
    $.ajax({
        type: 'GET',
        url: 'http://192.168.0.14/servidor/controller/controllerTarefas.php?ctrl=exibir',
        
        //Se a conexão for bem sucedida
        success: function(data){
            
            $("#lista").html(data);
        },

        //Se a conexão não for bem sucedida
        error: function(data){
            Swal.fire({
                icon: 'error',
                text: 'Erro ao tentar Conexão!',
            });
        }
    });
}

//Exibir Tarefas
ExibirTarefas();