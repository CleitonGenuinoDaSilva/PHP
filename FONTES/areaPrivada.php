<?php
    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: index.php");
        exit;
    }
    else
    {
        // Apaga todas as variáveis da sessão
        $_SESSION = array();
        // Se é preciso matar a sessão, então os cookies de sessão também devem ser apagados.
        // Nota: Isto destruirá a sessão, e não apenas os dados!
        if (ini_get("session.use_cookies")) 
        {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        // Por último, destrói a sessão
        session_destroy();   
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="pt-br">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <!--===============================================================================================-->	
	    <link rel="icon" type="image/png" href="IMAGENS/logo_link.png"/>
    </head>
    <body>
    Seja bem vindo !!!
    Conteudo Principal do seu site está aqui olha que maravilha as paginas são dinamicas muito bom isso !!!
    <a href="sair.php">Sair</a> 
    </body>
</html>