<html>
  <?php 
  include('views/header.php'); //Version 0.3.1 ?>
   <body>

<?php
  if(!isset($SESSION["user"])){
    include("views/login.php");
  }
    

?>

  <?php include('views/footer.php'); ?>


   </body>
</html>