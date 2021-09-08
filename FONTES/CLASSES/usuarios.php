<?php
class Usuario
{

    private $pdo;

    public function conectar()
    { 
        /* create database desenv;*/
        /* USE desenv;*/
        /* create table usuarios( id_usuario int AUTO_INCREMENT PRIMARY key,nome varchar(30),telefone varchar(30),email varchar(40),senha varchar(32));*/
        global $pdo;
        global $msgError;
        $msgError = "";
        $nome    = "desenv";
        $host    = "127.0.0.1";
        $usuario = "icfcurso";
        $senha   = "icf@advpl";
        try {
            //Controle de excessão
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
            return true; // conectado com sucesso
        } catch (PDOException $e) {
            $msgError = $e->getMessage();
            return false; // erro de conexão
        }
    }

    public function cadastrar($nome, $telefone, $email, $senha){
        global $pdo;
        // Verificar se já existe e-mail cadastrado
        $sql = $pdo->prepare("SELECT ID_USUARIO FROM usuarios WHERE email = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();

        if ($sql->rowCount()>0)
        {
            return false; // já cadastrado
        }else
        {
            $sql = $pdo->prepare("INSERT INTO usuarios(nome,telefone,email,senha)
            VALUES( :n, :t, :e, :s )");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":t",$telefone);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            return true; // cadastrado com sucesso
        }        
    }

    public function logar($email, $senha){
        global $pdo;
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios where email = :e AND senha = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();
        if ($sql->rowCount() > 0)
        {// entart no sistema (sessao)
            $dado = $sql->fetch();
            session_set_cookie_params(0);
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];
            return true; // Logado com sucesso
        }else
        {
            return false; // Não foi possivel logar
        }   
        
    }

}
?>