<?php

session_start();

if(!isset($_SESSION['login'])){
    ?>
     <script text="text/javascript">
         window.location = 'login.php';
     </script>
     <?php
}else{
    
}

?>


