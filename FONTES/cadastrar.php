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
        <div id="corpo-form-cad">
            <h1>Cadastrar</h1>
            <form method="POST">
                <input type="text" name="nome" placeholder="Nome completo" maxlength="30">
                <input type="text" name="telefone" placeholder="Telefone" maxlength="30">
                <input type="email" name="email" placeholder="Usuário" maxlength="40">
                <input type="password" name="senha" placeholder="Senha" maxlength="15">
                <input type="password" name="confSenha" placeholder="Confirmar Senha">
                <input type="submit" name="salvar" value="Cadastrar">
            </form>
        </div>
    <?php
        /*Verificar se clicou no botao*/
        if (isset($_POST['nome']))
        {
            $nome           = addslashes($_POST['nome']); /*addslashes retira codigo malicioso no forms*/
            $telefone       = addslashes($_POST['telefone']);
            $email          = addslashes($_POST['email']);
            $senha          = addslashes($_POST['senha']);
            $confirmaSenha  = addslashes($_POST['confSenha']);

            /*Verifica se está vaziu*/
            if ( !empty($nome) && !empty($telefone) && !empty($email) && !empty($senha)&& !empty($confirmaSenha) )  
            {       
                if( $u->conectar())
                {/*Se estiver em branco não deu erro de conexão*/
                    if($senha == $confirmaSenha)
                    {
                        if( $u->cadastrar( $nome,$telefone,$email,$senha) )
                        { /*Fecho a div para ficar html para edição echo "Cadastrado com sucesso ! Acesse para entrar!";*/
                            ?>
                            <div id="msg-sucesso">
                                Cadastrado com sucesso ! Acesse para entrar!
                            </div>
                            <?php
                            /*Abro a div novamente para interpretar php a partir daqui*/
                        }
                        else
                        { ?>
                        <div class="msg-erro">
                            Email ja cadastrado !
                        </div>
                        <?php
                        }
                    }
                    else
                    { ?>
                    <div class="msg-erro">
                        Senha e confirmar não correspondem !
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