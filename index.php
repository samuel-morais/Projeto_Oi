<?php
require 'connect/conexao.php';
// Recebe o termo de pesquisa se existir
$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';

// Verifica se o termo de pesquisa está vazio, se estiver executa uma consulta completa
if (empty($termo)):

	$conexao = conexao::getInstance();
	$sql = 'SELECT id_circuito, circuito, velocidade, valor_contrato, numero_logico, data_homologacao, status FROM inventario_oi';
	$stm = $conexao->prepare($sql);
	$stm->execute();
	$circuitos = $stm->fetchAll(PDO::FETCH_OBJ);

else:

	// Executa uma consulta baseada no termo de pesquisa passado como parâmetro
	$conexao = conexao::getInstance();
	$sql = 'SELECT id_circuito, circuito, velocidade, valor_contrato, numero_logico, data_homologacao, status FROM inventario_oi WHERE circuito LIKE :circuito OR numero_logico LIKE :numero_logico';
	$stm = $conexao->prepare($sql);
	$stm->bindValue(':circuito', $termo.'%');
	$stm->bindValue(':numero_logico', $termo.'%');
	$stm->execute();
	$circuitos = $stm->fetchAll(PDO::FETCH_OBJ);

endif;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Listagem de Circuitos</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<div class='container'>
		<fieldset>

			<!-- Cabeçalho da Listagem -->
			<legend><h1>Listagem de Circuitos </h1></legend>

			<!-- Formulário de Pesquisa -->
			<form action="" method="get" id='form-contato' class="form-horizontal col-md-10">
				<label class="col-md-2 control-label" for="termo">Pesquisar</label>
				<div class='col-md-7'>
			    	<input type="text" class="form-control" id="termo" name="termo" placeholder="Infome o circuito ou Número Lógico">
				</div>
			    <button type="submit" class="btn btn-primary">Pesquisar</button>
			    <a href='index.php' class="btn btn-primary">Ver Todos</a>
			</form>

			<!-- Link para página de cadastro -->
			<a href='cadastro.php' class="btn btn-success pull-right">Cadastrar Circuito</a>
			<div class='clearfix'></div>

			<?php if(!empty($circuitos)):?>

				<!-- Tabela  -->
				<table class="table table-striped">
					<tr class='active'>
						<th>circuito</th>
						<th>velocidade</th>
						<th>valor_contrato</th>
						<th>numero_logico</th>
						<th>data_homologacao</th>
						<th>Status</th>
						<th>Ação</th>
					</tr>
					<?php foreach($circuitos as $circuito):?>
						<tr>
							<td><?=$circuito->circuito?></td>
							<td><?=$circuito->velocidade?></td>
							<td><?=$circuito->valor_contrato?></td>
							<td><?=$circuito->numero_logico?></td>
							<td><?=$circuito->data_homologacao?></td>
							<td><?=$circuito->status?></td>
							<td>
								<a href='editar.php?id_circuito=<?=$circuito->id_circuito?>' class="btn btn-primary">Editar</a>
								<a href='javascript:void(0)' class="btn btn-danger link_exclusao" rel="<?=$circuito->id_circuito?>">Excluir</a>
							</td>
						</tr>	
					<?php endforeach;?>
				</table>

			<?php else: ?>

				<!-- Mensagem caso não exista circuitos ou não encontrado  -->
				<h3 class="text-center text-primary">Não existem circuitos cadastrados!</h3>
			<?php endif; ?>
		</fieldset>
	</div>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>