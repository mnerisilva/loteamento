<?php

    $senha = $_GET['senha'];
    
    # Criptografia em base64

    $senha = md5($senha);

    echo $senha;
    

?>
