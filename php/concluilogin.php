<?php
include("conexao.php");

$email     = $_POST['email'];
$senha     = $_POST['senha'];
$senhaHash = hash('sha256', $senha);

$comando = "SELECT * FROM usuarios WHERE emailUsuarios ='{$email}' AND senhaUsuarios = '{$senhaHash}' AND ativoUsuarios = 1";

$resultado = mysqli_query($conexao, $comando);
$usuarioRetorno = mysqli_fetch_assoc($resultado);

echo $email;
echo $senhaHash;
echo $usuarioRetorno;

if($usuarioRetorno == ""){
	echo "<script>
	alert('Usuário ou senha inválidos!');
	location.href='login.php';
	</script>";
}else{
	session_start();
	$_SESSION['emailUsuario']  = $email;
	$_SESSION['usuarioLogado'] = 1;
	//redirecionando para paginaPrincipal.php
	header("Location: ../index.php");
}
?>