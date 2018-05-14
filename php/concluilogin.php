<?php
session_start();
include("conexao.php");

$email     = $_POST['email'];
$senha     = $_POST['senha'];
$senhaHash = hash('sha256', $senha);

$comandoUsuario   = "SELECT * FROM usuarios WHERE emailUsuarios ='{$email}' AND senhaUsuarios = '{$senhaHash}' AND ativoUsuarios = 1";
$resultadoUsuario = mysqli_query($conexao, $comandoUsuario   );
$usuarioRetorno   = mysqli_fetch_assoc($resultadoUsuario);

$comando = "SELECT choris, projetos FROM usuarios WHERE emailUsuarios ='{$email}' AND senhaUsuarios = '{$senhaHash}' AND ativoUsuarios = 1";
$resultado = $conexao->query($comando) OR trigger_error($conexao->error, E_USER_ERROR);

while($usuario = $resultado->fetch_object()){
	if($usuario->choris == 1){
		$_SESSION['choris'] = 1;
	}else{
		$_SESSION['choris'] = 0;
	}
	if($usuario->projetos== 1){
		$_SESSION['projetos'] = 1;
	}else{
		$_SESSION['projetos'] = 0;
	}
}

if($usuarioRetorno == ""){
	echo "<script>
	alert('Usuário ou senha inválidos!');
	location.href='login.php';
	</script>";
}else{
	$_SESSION['emailUsuario']  = $email;
	$_SESSION['usuarioLogado'] = 1;
	echo "<script>
	alert('Usuário logado com sucesso!');
	location.href='../index.php';
	</script>";
}
?>