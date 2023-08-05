<?php

if (isset($_POST['email']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    
    require '../php/conexao.php';

    $login = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    
}else{
    header("Location: ../php/login.php");
}


?>