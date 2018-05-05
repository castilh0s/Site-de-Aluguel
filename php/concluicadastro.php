<?php
	include("conexao.php");
	
	$nome      = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$email     = $_POST['email'];
	$senha     = $_POST['senha'];
	
    $senhaHash = hash('sha256', $senha);
    
    $verificaComando   = "SELECT emailUsuarios FROM usuarios WHERE emailUsuarios = '{$email}'";
    $verificaResultado = mysqli_query($conexao, $verificaComando);
    $arrayUsuarios     = mysqli_fetch_array($verificaResultado);
    $emailArray        = $arrayUsuarios['emailUsuarios'];
    
    if($emailArray == $email){
        echo "<script>
            alert('E-mail já cadastrado!');
            location.href = 'cadastro.php';
        </script>";
    }else{
        $comando = "INSERT INTO usuarios (nomeUsuarios, sobrenomeUsuarios, emailUsuarios, senhaUsuarios)
	                VALUES ('{$nome}', '{$sobrenome}', '{$email}', '{$senhaHash}')";
	
	    $resultado = mysqli_query($conexao, $comando);
	
	    if($resultado == true){
		    echo "<script>
    		    alert('Usuário cadastrado com sucesso!');
	    	    location.href = '../index.php';
		    </script>";
	    }else{
		    echo "<script>
			    alert('Usuário cadastrado com sucesso!');
			    location.href = 'cadastro.php';
		    </script>";
        }
    }
?>