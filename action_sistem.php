<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Sistema de Cadastro</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<div class='container box-mensagem-crud'>
		<?php 
		require 'connect/conexao.php';

		// Atribui uma conexão PDO
		$conexao = conexao::getInstance();

		// Recebe os dados enviados pela submissão
		$acao  = (isset($_POST['acao'])) ? $_POST['acao'] : '';
		$id_circuito    = (isset($_POST['id_circuito'])) ? $_POST['id_circuito'] : '';
		$circuito  = (isset($_POST['circuito'])) ? $_POST['circuito'] : '';
		$velocidade  = (isset($_POST['velocidade'])) ? $_POST['velocidade'] : '';
		$valor_contrato = (isset($_POST['valor_contrato'])) ? $_POST['valor_contrato'] : '';
		$numero_logico  = (isset($_POST['numero_logico'])) ? $_POST['numero_logico'] : '';
		$data_homologacao  = (isset($_POST['data_homologacao'])) ? $_POST['data_homologacao'] : '';
		$status    		  = (isset($_POST['status'])) ? $_POST['status'] : '';


		// Valida os dados recebidoS
		$mensagem = '';
		if ($acao == 'editar' && $id_circuito == ''):
		    $mensagem .= '<li>ID do registros desconhecido.</li>';
	    endif;

	    // Se for ação diferente de excluir valida os dados obrigatórios
	    if ($acao != 'excluir'):
			if ($circuito == '' || strlen($circuito) < 3):
				$mensagem .= '<li>Favor preencher o Circuito.</li>';
		    endif;

			if ($velocidade == '' || strlen($velocidade) < 3):
				$mensagem .= '<li>Favor preencher a Velocidade do cct .</li>';
		    endif;

			if ($valor_contrato == '' || strlen($valor_contrato) < 3):
				$mensagem .= '<li>Favor preencher o Valor do Contrato.</li>';
		    endif;

			if ($numero_logico == '' || strlen($numero_logico) < 3):
				$mensagem .= '<li>Favor preencher o Número Lógico.</li>';
		    endif;

			if ($status == ''):
			   $mensagem .= '<li>Favor preencher o Status.</li>';
			endif;

			if ($mensagem != ''):
				$mensagem = '<ul>' . $mensagem . '</ul>';
				echo "<div class='alert alert-danger' role='alert'>".$mensagem."</div> ";
				exit;
			endif;

			// Constrói a data no formato ANSI yyyy/mm/dd
			$data_temp = explode('/', $data_homologacao);
			$data_ansi = $data_temp[2] . '/' . $data_temp[1] . '/' . $data_temp[0];
		endif;



		// Verifica se foi solicitada a inclusão de dados
		if ($acao == 'incluir'):

			$sql = 'INSERT INTO inventario_oi (circuito, velocidade, valor_contrato, numero_logico, data_homologacao, status) VALUES(:circuito, :velocidade, :valor_contrato, :numero_logico, :data_homologacao, :status)';

			$stm = $conexao->prepare($sql);
			$stm->bindValue(':circuito', $circuito);
			$stm->bindValue(':velocidade', $velocidade);
			$stm->bindValue(':valor_contrato', $valor_contrato);
			$stm->bindValue(':numero_logico', $numero_logico);
			$stm->bindValue(':data_homologacao', $data_ansi);
			$stm->bindValue(':status', $status);
			$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao inserir registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=index.php'>";
		endif;


		// Verifica se foi solicitada a edição de dados
		if ($acao == 'editar'):
 

			$sql = 'UPDATE inventario_oi SET circuito=:circuito, velocidade=:velocidade, valor_contrato=:valor_contrato, numero_logico=:numero_logico, data_homologacao=:data_homologacao, status=:status WHERE id_circuito = :id_circuito';

			$stm = $conexao->prepare($sql);
			$stm->bindValue(':circuito', $circuito);
			$stm->bindValue(':velocidade', $velocidade);
			$stm->bindValue(':valor_contrato', $valor_contrato);
			$stm->bindValue(':numero_logico', $numero_logico);
			$stm->bindValue(':data_homologacao', $data_ansi);
			$stm->bindValue(':status', $status);
			$stm->bindValue(':id_circuito', $id_circuito);
			$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao editar registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=index.php'>";
		endif;


		// Verifica se foi solicitada a exclusão dos dados
		if ($acao == 'excluir'):

			$sql = 'DELETE FROM inventario_oi WHERE id_circuito = :id_circuito';
			$stm = $conexao->prepare($sql);
			$stm->bindValue(':id_circuito', $id_circuito);
			$retorno = $stm->execute();

			if ($retorno):
				echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...</div> ";
		    else:
		    	echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div> ";
			endif;

			echo "<meta http-equiv=refresh content='3;URL=index.php'>";
		endif;
		?>

	</div>
</body>
</html>