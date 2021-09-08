<?php
    require_once 'CLASSES\usuarios.php';
    $u = new Usuario;
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <!--===============================================================================================-->	
	    <link rel="icon" type="image/png" href="IMAGENS/logo_link.png"/>
        <title>Cursos ADVPL</title>
        <link rel="stylesheet" href="CSS/estilo.css">
    </head>
    <body>
        <div id="corpo-form">
            <h1>Entrar</h1>
            <form method="POST">
                <input type="email" name="email" placeholder="Usuário" maxlength="40">
                <input type="password" name="senha" placeholder="Senha" maxlength="15">
                <input type="submit" name="Acessar">
                <a href="cadastrar.php">Ainda não é incrito?<strong>Cadastre-se !<strong></a>
            </form>
        </div>
    <?php
        /*Verificar se clicou no botao*/
        if (isset($_POST['email']))
        {
            $email          = addslashes($_POST['email']);/*addslashes retira codigo malicioso no forms*/
            $senha          = addslashes($_POST['senha']);

            /*Verifica se está vaziu*/
            if ( !empty($email) && !empty($senha) )  
            {       
                if( $u->conectar() )
                {/*Se estiver em branco não deu erro de conexão*/
                        if( $u->logar($email,$senha) )
                        { /*Fecho a div para ficar html para edição echo "Cadastrado com sucesso ! Acesse para entrar!";*/
                            ?>
                            <div id="msg-sucesso">
                                Logado com sucesso !
                            </div>
                            <?php header("Location: areaPrivada.php");
                            /*Abro a div novamente para interpretar php a partir daqui*/
                        }
                        else
                        { ?>
                        <div class="msg-erro">
                            Email e/ou senha estão incorretos !
                        </div>
                        <?php
                        }
                }
                else
                { ?>
                <div class="msg-erro">
                    <?php echo "Erro:".$msgError; ?>
                </div>
                <?php
                }
            }
            else
            {   
                ?>
                <div class="msg-erro">
                    Preencher todos os campos!
                </div>
                <?php
            }
        }
        /* create table usuarios( id_usuario int AUTO_INCREMENT PRIMARY key,nome varchar(30),telefone varchar(30),email varchar(40),senha varchar(32));*/
    ?>
    </body>
</html>