<?php
    ob_start();
    session_start();
    header("Content-type: text/html; charset=utf-8");
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119029375-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-119029375-1');
    </script>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home - Filminhos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/index.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/padrao.css" />
    <script src="js/index.js"></script>
</head>
<body>
    <ul class="header">
        <li class="contHeader"><a class="active" href="index.php">HOME</a></li>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">GÊNEROS</a>
            <div class="dropdown-content">
            <?php
                include("php/conexao.php");

                $comandoGen   = "SELECT * FROM generos ORDER BY descGenero ASC";
                $resultadoGen = mysqli_query($conexao, $comandoGen);
                $arrayGen  = array();

                while($u = mysqli_fetch_assoc($resultadoGen)){
                    array_push($arrayGen, $u);
                }

                foreach($arrayGen as $genero){
            ?>      
                <a href="php/genero.php?q=<?php echo $genero['idGenero']; ?>"><?php echo $genero['descGenero']; ?></a>  
                <?php
		        }
	            ?>
            </div>
        </li>
        <li class="contHeader"><a href="php/novidades.php">NOVIDADES</a></li>
        <?php
            if($_SESSION['choris'] == 1){
                ?>
                <li class="contHeader"><a href="choris/index.php">CHORIS</a></li>
                <?php
            }
	    if($_SESSION['projetos'] == 1){
                ?>
                <li class="contHeader"><a href="projetos/index.php">PROJETOS</a></li>
                <?php
            }
        ?>

        <?php
            if($_SESSION['usuarioLogado'] == 1){
                //botão com nome do usuário redirecionando para a página do mesmo
                ?>
                <li class="contHeaderDir"><a href="php/logout.php">LOGOUT</a></li>
                <li class="contHeaderDir"><a href="php/minhaconta.php">MINHA CONTA</a></li>
                <?php
            }else{
                ?>
                <li class="contHeaderDir"><a href="php/login.php">LOGIN</a></li>
                <li class="contHeaderDir"><a href="php/cadastro.php">CADASTRE-SE</a></li>
                <?php
            }
        ?>
        <li class="contHeaderDir">
            <!-- pesquisa em js não funciona com o header fixado no topo da página, ficando mais funcional um formulário com metódo get -->
            <form action="php/busca.php" method="get">
                <input class="campoBusca" type="text" name="q" placeholder="Palavra-Chave">
                <input class="btnBusca" type="submit" value="BUSCAR">
            </form>
        </li>
    </ul>
    <br/>
    <br/>
    <!-- FIM DO HEADER -->
    <?php
        $comandoFilmes = "SELECT * FROM filmes ORDER BY nomeFilme ASC";
        $resultadoFilmes = $conexao->query($comandoFilmes) OR trigger_error($conexao->error, E_USER_ERROR);
    ?>
        <?php
        while($filmes = $resultadoFilmes->fetch_object()){
        ?>
            <table align="center" bgcolor="#969fa3" class="tblFilme">
                <tr>
                    <td colspan="2">
                        <h2 class="tituloFilme"><?php echo $filmes->nomeFilme; ?></h2></li>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <center>
                            <img src=<?php echo $filmes->posterFilme; ?> alt="Perfil" height="250" width="169">
                        </center>
                    </td>
                </td>
                <tr>
                    <td>
                        <p class="diretorFilme">
                            Diretor: <?php echo $filmes->diretorFilme; ?> | Lançamento: <?php echo $filmes->lancamentoFilme; ?>
                        </p>
                    </td>
                </tr>
            </table>
            <br/>
        <?php
        }
        ?>
</body>
</html>

<?php
    ob_end_flush();
?>