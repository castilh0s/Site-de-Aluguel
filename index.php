<?php
    ob_start();
    session_start();
    header("Content-type: text/html; charset=utf-8");
?>

<!DOCTYPE html>
<html>
<head>
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

                $comando   = "SELECT * FROM generos ORDER BY descGenero ASC";
                $resultado = mysqli_query($conexao, $comando);
                //$linhas    = mysqli_num_rows($resultado);
                $arrayGen  = array();

                while($u = mysqli_fetch_assoc($resultado)){
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
    <!-- FIM DO HEADER -->

    
</body>
</html>

<?php
    ob_end_flush();
?>