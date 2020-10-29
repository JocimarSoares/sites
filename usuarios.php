<?php

Class Usuario
{
	private $pdo;
	public $msgErro = "";// tudo ok

	public function conectar($nome, $host, $usuario, $senha)
    {
	    global $msgErro;
	    try
	    {
	        $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        }catch (PDOException $e){
    	$msgErro = $e->getMessage();
        }
    }

    public function cadastrar($nome, $empresa, $telefone, $email, $usuario, $senha)
    {
        global $pdo;
        //verificar se já existe o email cadastrado
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE usuario = :u");
        $sql->bindValue(":u",$usuario);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
        	return false; //já esta cadastrado
        }
        else
        {
        	//caso não, Cadastrar
        	$sql = $pdo->prepare("INSERT INTO usuarios (nome, empresa, telefone, email, usuario, senha) VALUES (:n, :p, :t, :e, :u, :s)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":p",$empresa);
            $sql->bindValue(":t",$telefone);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":u",$usuario);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            return true;// Cadastrado com sucesso
        }

        
    }


    public function logar($usuario, $senha)
    {
        global $pdo;
        //verificar se usuario e senha estão cadastrados, se sim
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE usuario = :u AND senha = :s");
        $sql->bindValue(":u",$usuario);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();
        if($sql->rowCount() > 0)
        {
        	//entrar no sistema (sessao)
        	$dado = $sql->fetch();
        	session_start();
        	$_SESSION['id_usuario'] = $dado['id_usuario'];
        	return true; //logar com sucesso
        }
        else
        {
            return false; //não foi possivel logar
        }
        
    }
}
?>
