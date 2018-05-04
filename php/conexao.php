<?php
    //('local do banco', 'user', 'senha', 'nome do banco')
    $conexao = mysqli_connect('localhost', 'root', '', 'filmi831_filminhos');
    $utf8    = mysqli_set_charset($conexao, 'utf8');
?>
