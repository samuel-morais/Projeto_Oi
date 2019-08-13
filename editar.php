<?php
require 'connect/conexao.php';

// Recebe o id do circuito  via GET
$id_circuito = (isset($_GET['id_circuito'])) ? $_GET['id_circuito'] : '';

// Valida se existe um id e se ele é numérico
if (!empty($id_circuito) && is_numeric($id_circuito)):

	// Captura os dados do circuito solicitado
	$conexao = conexao::getInstance();
	$sql = 'SELECT id_circuito, circuito, velocidade, valor_contrato, numero_logico, data_homologacao, status FROM inventario_oi WHERE id_circuito = :id_circuito';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(':id_circuito', $id_circuito);
	$stm->execute();
	$circuito = $stm->fetch(PDO::FETCH_OBJ);

	if(!empty($circuito)):

		// Formata a data no formato nacional
		$array_data     = explode('-', $circuito->data_homologacao);
		$data_formatada = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];

	endif;

endif;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Edição de Circuito</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<div class='container'>
		<fieldset>
			<legend><h1>Formulário - Edição de Circuito</h1></legend>
			
			<?php if(empty($circuito)):?>
				<h3 class="text-center text-danger">Circuito não encontrado!</h3>
			<?php else: ?>
				<form action="action_sistem.php" method="post" id='form-contato' enctype='multipart/form-data'>

				    <div class="form-group">
			      <label for="circuito">Circuito</label>
			      <input type="text" class="form-control" id="circuito" name="circuito" placeholder="Infome o circuito">
			      <span class='msg-erro msg-circuito'></span>
			    </div>
			       <div class="form-group">
			      <label for="velocidade">Velocidade</label>
			      <input type="text" class="form-control" id="velocidade" name="velocidade" placeholder="Infome a velocidade">
			      <span class='msg-erro msg-circuito'></span>
			    </div>

			       <div class="form-group">
			      <label for="valor_contrato">Valor Contrato</label>
			      <input type="text" class="form-control" id="valor_contrato" name="valor_contrato" placeholder="Infome o valor do contrato">
			      <span class='msg-erro msg-circuito'></span>
			    </div>
			      <div class="form-group">
			      <label for="numero_logico">Numero Lógico</label>
			      <input type="text" class="form-control" id="numero_logico" name="numero_logico" placeholder="Infome o Numero Lógico">
			      <span class='msg-erro msg-circuito'></span>
			    </div>
			    <div class="form-group">
			      <label for="data_homologacao">Data de Homologação</label>
			      <input type="data_homologacao" class="form-control" id="data_homologacao" maxlength="10" name="data_homologacao">
			      <span class='msg-erro msg-data'></span>
			    </div>
			    <div class="form-group">
			      <label for="status">Status</label>
			      <select class="form-control" name="status" id="status">
				    <option value="">Selecione o Status</option>
				    <option value="Ativo">Ativo</option>
				    <option value="Inativo">Inativo</option>
				  </select>
				  <span class='msg-erro msg-status'></span>
			    </div>
				    <input type="hidden" name="acao" value="editar">
				    <input type="hidden" name="id_circuito" value="<?=$circuito->id_circuito?>">
				    <button type="submit" class="btn btn-primary" id='botao'> 
				      Gravar
				    </button>
				    <a href='index.php' class="btn btn-danger">Cancelar</a>
				</form>
			<?php endif; ?>
		</fieldset>

	</div>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>