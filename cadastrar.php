<?php
     require_once 'usuarios.php';
     $u = new Usuario
?>

<html lang="pt-br">
	<head>
		<title>Cadastro do Usuário GEDO</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="style1.css">
	</head>

	<body>
	<div id="card">

		<img src="imag/GEDO Logo002.jpg">

		<h2>CADASTRO DO USUÁRIO</h2>

		<form method="POST">

			<label>Nome Completo:</label>
			<input type="text" name="nome" placeholder="Digite seu nome completo" maxlength="30">

	    	<label>Empresa:</label>
			<input type="text" name="empresa" placeholder="Digite o nome da sua empresa" maxlength="50">

			<label>Telefone:</label>
			<input type="text" name="telefone" placeholder="Digite seu Telefone" maxlength="30">

        	<label>E-mail:</label>
			<input type="email" name="email" placeholder="Digite seu E-mail" maxlength="40">

			<label>Usuário:</label>
			<input type="text" name="usuario" placeholder="Digite seu usuário" maxlength="30">

			<label>Senha:</label>
			<input type="password" name="senha" placeholder="Digite sua senha" maxlength="15">

			<label>Confirme a Senha:</label>
			<input type="password" name="confsenha" placeholder="Digite novamente a sua senha">

			<input type="submit" value="CADASTRAR">
			<label></label>

		</form>

	</div>

	<?php
     //verificar se clicou no botão
	if(isset($_POST['nome']))
	{
		$nome = addslashes($_POST['nome']);
		$empresa = addslashes($_POST['empresa']);
		$telefone = addslashes($_POST['telefone']);
		$email = addslashes($_POST['email']);
		$usuario = addslashes($_POST['usuario']);
		$senha = addslashes($_POST['senha']);
		$confsenha = addslashes($_POST['confsenha']);
		//verificar se esta preenchido
		if(!empty($nome) && !empty($empresa) && !empty($telefone) && !empty($email) && !empty($usuario) && !empty($senha) && !empty($confsenha))
		{
			$u->conectar('localhost:8080', '', '', 'projeto_login');
			if($u->msgErro =="")// se esta vazio, tudo ok
			{
				if($senha == $confsenha)
				{
				    if($u->cadastrar($nome,$empresa,$telefone,$email,$usuario,$senha))
                    {
                    	echo "Cadastrado com sucesso!";
                    }
                    else
                    {
                    	echo "Usuário já cadastrado!";
                    }
				}
				else
				{
					echo "Senhe e confirmar senha não correspondem!";
				}
		    }
		    else
		    {
		    	echo "Erro: ".$u->msgErro;
		    }

		    }else
		    {
			    echo "Preencha todos os campos";
		    }


	}


	?>
	</body>

</html>
