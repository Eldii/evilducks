<?php
session_start();
require("function.php");
if(isset($_GET['demos']) && !empty($_GET)){
  foreach ($_GET['demos'] as $key => $demo) {
    if(!file_exists($GLOBALS['chemin_demo'] . $demo)){
      echo "Demo '$demo' does not exists ! ";
      die();
    }
  }
  isset($_GET['connexion']) ? archiveDemo($_GET['demos'], $_GET['connexion']) : archiveDemo($_GET['demos']);
  telechargeDemo();
}else{
  header("Location: index.php");
}
 ?>
