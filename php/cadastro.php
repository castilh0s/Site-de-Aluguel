<?php
    header("Content-type: text/html; charset=utf-8");
    session_start();
    if($_SESSION['usuarioLogado'] == 1){
        echo "<script>
        alert('Você não pode acessar essa página');
        location.href='../index.php';
        </script>";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119029375-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-119029375-1');
    </script>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cadastro - Filminhos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/cadastro.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/padrao.css" />
    <script src="js/index.js"></script>
</head>
<body>
    <ul class="header">
        <li class="contHeader"><a href="../index.php">HOME</a></li>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">GÊNEROS</a>
            <div class="dropdown-content">
            <?php
                include("conexao.php");

                $comando   = "SELECT * FROM generos ORDER BY descGenero ASC";
                $resultado = mysqli_query($conexao, $comando);
                $linhas    = mysqli_num_rows($resultado);
                $arrayGen  = array();

                while($u = mysqli_fetch_assoc($resultado)){
                    array_push($arrayGen, $u);
                }

                foreach($arrayGen as $genero){
            ?>      
                <a href="genero.php?q=<?php echo $genero['idGenero']; ?>"><?php echo $genero['descGenero']; ?></a>  
                <?php
		        }
	            ?>
            </div>
        </li>
        <li class="contHeader"><a href="novidades.php">NOVIDADES</a></li>
        <?php
            if($_SESSION['usuarioLogado'] == 1){
                //botão com nome do usuário redirecionando para a página do mesmo
                ?>
                <li class="contHeaderDir"><a href="logout.php">LOGOUT</a></li>
                <li class="contHeaderDir"><a href="minhaconta.php">MINHA CONTA</a></li>
                <?php
            }else{
                ?>
                <li class="contHeaderDir"><a href="login.php">LOGIN</a></li>
                <li class="contHeaderDir"><a class="active" href="cadastro.php">CADASTRE-SE</a></li>
                <?php
            }
        ?>
        <li class="contHeaderDir">
            <!-- pesquisa em js não funciona com o header fixado no topo da página, ficando mais funcional um formulário com metódo get -->
            <form action="busca.php" method="get">
                <input class="campoBusca" type="text" name="q" placeholder="Palavra-Chave">
                <input class="btnBusca" type="submit" value="BUSCAR">
            </form>
        </li>
    </ul>
    <!-- FIM DO HEADER -->

    <form class="formCadastro" action="concluicadastro.php" method="POST">
	    <table align="center" bgcolor="#969fa3" class="tabela">
            <tr>
                <td colspan="2">
                    <center><h1 class="titulo">CRIE SUA CONTA</h1></center>
                </td>
            </tr>
            <tr>
                <td><label class="descricao">NOME:</label></td>
                <td><input type="text" name="nome" class="inputs"></td>
            </tr>
            <tr>
                <td><label class="descricao">SOBRENOME:</label></td>
                <td><input type="text" name="sobrenome" class="inputs"></td>
            </tr>
            <tr>
                <td><label class="descricao">E-MAIL:</label></td>
                <td><input type="text" name="email" class="inputs"></td>
            </tr>
            <tr>
                <td><label class="descricao">SENHA:</label></td>
                <td><input type="password" name="senha" class="inputs"></td>
            </tr>
	
            <tr>
                <td colspan="2">
                    <center><button type="submit" class="botoes">CRIAR</button></center>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>