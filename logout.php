<?php
session_start();
session_destroy();
header("location:index.php");
setcookie('name', '',time()-3000);
?>