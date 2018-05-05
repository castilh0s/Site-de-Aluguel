<?php
session_start();
if(isset($_SESSION['emailUsuario'])) {
	session_destroy();
	session_start();
	$_SESSION['usuarioLogado'] = 0;
	echo "<script>
	alert('Usuário deslogado com sucesso!');
	location.href='../index.php';
	</script>";
}
?>