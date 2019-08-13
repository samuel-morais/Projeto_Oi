/* Atribui ao Evento submit do formulário a função de validação de dados*/
var form = document.getElementById("form-contato");
if (form != null && form.addEventListener) {                   
    form.addEventListener("submit", validaCadastro);
} else if (form != null && form.attachEvent) {                  
    form.attachEvent("onsubmit", validaCadastro);
}


/* Atribui ao evento keypress do input data de Homologacao a função para formatar o data (dd/mm/yyyy) */
var inputDataHomologacao = document.getElementById("data_homologacao");
if (inputDataHomologacao != null && inputDataHomologacao.addEventListener) {                   
    inputDataHomologacao.addEventListener("keypress", function(){mascaraTexto(this, '##/##/####')});
} else if (inputDataHomologacao != null && inputDataHomologacao.attachEvent) {                  
    inputDataHomologacao.attachEvent("onkeypress", function(){mascaraTexto(this, '##/##/####')});
}


/* Atribui ao evento click do link de exclusão na página de consulta a função confirmaExclusao */
var linkExclusao = document.querySelectorAll(".link_exclusao");
if (linkExclusao != null) { 
	for ( var i = 0; i < linkExclusao.length; i++ ) {
		(function(i){
			var id_circuito = linkExclusao[i].getAttribute('rel');

			if (linkExclusao[i].addEventListener){
		    	linkExclusao[i].addEventListener("click", function(){confirmaExclusao(id_circuito);});
			}else if (linkExclusao[i].attachEvent) { 
				linkExclusao[i].attachEvent("onclick", function(){confirmaExclusao(id_circuito);});
			}
		})(i);
	}
}

/* Função para validar os dados antes da submissão dos dados */
function validaCadastro(evt){
	var circuito = document.getElementById('circuito');
	var velocidade = document.getElementById('velocidade');
	var valor_contrato = document.getElementById('valor_contrato');
	var numero_logico = document.getElementById('numero_logico');
	var data_homologacao = document.getElementById('data_homologacao');
	var status = document.getElementById('status');
	var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var contErro = 0;


	/* Validação do campo circuito */
	caixa_circuito = document.querySelector('.msg-circuito');
	if(circuito.value == ""){
		caixa_circuito.innerHTML = "Favor preencher o Circuito";
		caixa_circuito.style.display = 'block';
		contErro += 1;
	}else{
		caixa_circuito.style.display = 'none';
	}

	/* Validação do campo velocidade */
	caixa_velocidade = document.querySelector('.msg-velocidade');
	if(velocidade.value == ""){
		caixa_velocidade.innerHTML = "Favor preencher a velocidade";
		caixa_velocidade.style.display = 'block';
		contErro += 1;
	}else{
		caixa_velocidade.style.display = 'none';
	}

	/* Validação do campo valor do contrato */
	caixa_valor_contrato = document.querySelector('.msg-valor-contrato');
	if(valor_contrato.value == ""){
		caixa_valor_contrato.innerHTML = "Favor preencher o Valor do contrato";
		caixa_valor_contrato.style.display = 'block';
		contErro += 1;
	}else{
		caixa_valor_contrato.style.display = 'none';
	}

	/* Validação do campo numero logico */
	caixa_numero_logico = document.querySelector('.msg-numero-logico');
	if(numero_logico.value == ""){
		caixa_numero_logico.innerHTML = "Favor preencher o Numero Lógico";
		caixa_numero_logico.style.display = 'block';
		contErro += 1;
	}else{
		caixa_numero_logico.style.display = 'none';
	}

	/* Validação do campo status */
	caixa_status = document.querySelector('.msg-status');
	if(status.value == ""){
		caixa_status.innerHTML = "Favor preencher o Status";
		caixa_status.style.display = 'block';
		contErro += 1;
	}else{
		caixa_status.style.display = 'none';
	}

	if(contErro > 0){
		evt.preventDefault();
	}
}

/* Função para formatar dados conforme parâmetro enviado DATA */
function mascaraTexto(t, mask){
	var i = t.value.length;
	var saida = mask.substring(1,0);
	var texto = mask.substring(i);

	if (texto.substring(0,1) != saida){
		t.value += texto.substring(0,1);
	}
}

/* Função para exibir um alert confirmando a exclusão do registro*/
function confirmaExclusao(id_circuito){
	retorno = confirm("Deseja Realmente excluir esse Registro?")

	if (retorno){

	    //Cria um formulário
	    var formulario = document.createElement("form");
	    formulario.action = "action_sistem.php";
	    formulario.method = "post";

		// Cria os inputs e adiciona ao formulário
	    var inputAcao = document.createElement("input");
	    inputAcao.type = "hidden";
	    inputAcao.value = "excluir";
	    inputAcao.name = "acao";
	    formulario.appendChild(inputAcao); 

	    var inputId = document.createElement("input");
	    inputId.type = "hidden";
	    inputId.value = id_circuito;
	    inputId.name = "id_circuito";
	    formulario.appendChild(inputId);

	    //Adiciona o formulário ao corpo do documento
	    document.body.appendChild(formulario);

	    //Envia o formulário
	    formulario.submit();
	}
}
