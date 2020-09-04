<?PHP
 
# PHP 7
$conexao = mysqli_connect('localhost','root','') or die('Falha na conexão');
$banco = mysqli_select_db($conexao,'usuarios') or die('Falha ao conectar banco de dados');
mysqli_set_charset($conexao,'utf8');

?>