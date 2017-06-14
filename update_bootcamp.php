<?php
require_once('function.php');
if(isset($_POST['type']) && $_POST['type'] == "incremente"){
  incrementeBootcamp();
}elseif(isset($_POST['type']) && $_POST['type'] == "decremente"){
  decrementeBootcamp();
}

?>
