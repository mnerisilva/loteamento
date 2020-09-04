<?php

# Conectando no banco de dados
include('config.php');


$usuario_digitado   = $_POST['login_ide'];
$senha_digitada     = $_POST['senha_ide'];

$senha_digitada_crip= md5($senha_digitada);


 
//$sql = mysqli_query($conexao,"select * from tb_identificacao WHERE login_ide='$usuario_digitado' AND senha_ide='$senha_digitada_crip' LIMIT 1") or die("Erro mysqli_query");
$query = "select * from tb_identificacao WHERE login_ide='$usuario_digitado' AND senha_ide='$senha_digitada_crip' LIMIT 1";

/*while($dados=mysqli_fetch_assoc($sql))
    {
        echo $dados['login_ide'].'<br>';
    }*/


if ($result = mysqli_query($conexao, $query)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_assoc($result)) {
        printf ("%s (%s)\n", $row["login_ide"], $row["senha_ide"]);
        
        $nome_usuario = $row["nome_ide"];
        session_start();
        $_SESSION['login'] = $usuario_digitado;
        $_SESSION['nome'] = $nome_ide;
        ?>
        
        <script type="text/javascript">
           window.location = 'mapa.php';
        </script>
        
        <?php
        
    }

    /* free result set */
    mysqli_free_result($result);
}

/* close connection */
mysqli_close($conexao);

//echo '<br />'.$login.'<br />';
//echo $senha;

?>