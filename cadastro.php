 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Cadastro de Circuitos</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<div class='container'>
		<fieldset>
			<legend><h1>Formulário - Cadastro de Circuito</h1></legend>
			
			<form action="action_sistem.php" method="post" id='form-contato' enctype='multipart/form-data'>

			    <div class="form-group">
			      <label for="circuito">Circuito</label>
			      <input type="text" class="form-control" id="circuito" name="circuito" placeholder="Infome o circuito">
			      <span class='msg-erro msg-circuito'></span>
			    </div>
			       <div class="form-group">
			      <label for="velocidade">Velocidade</label>
			      <input type="text" class="form-control" id="velocidade" name="velocidade" placeholder="Infome a velocidade">
			      <span class='msg-erro msg-velocidade'></span>
			    </div>

			       <div class="form-group">
			      <label for="valor_contrato">Valor Contrato</label>
			      <input type="text" class="form-control" id="valor_contrato" name="valor_contrato" placeholder="Infome o valor do contrato">
			      <span class='msg-valor-contrato'></span>
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

			    <input type="hidden" name="acao" value="incluir">
			    <button type="submit" class="btn btn-primary" id='botao'> 
			      Gravar
			    </button>
			    <a href='index.php' class="btn btn-danger">Cancelar</a>
			</form>
		</fieldset>
	</div>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>