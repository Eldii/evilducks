<?php
	require("function.php");
    $idpseudo1 = isset($_POST['joueur1']) && !empty($_POST['joueur1']) ? $_POST['joueur1'] : "";
    $idpseudo2 = isset($_POST['joueur2']) && !empty($_POST['joueur2']) ? $_POST['joueur2'] : "";
    $scoremap1j1 = isset($_POST['scoremap1j1']) && !empty($_POST['scoremap1j1']) ? $_POST['scoremap1j1'] : "";
    $scoremap1j2 = isset($_POST['scoremap1j2']) && !empty($_POST['scoremap1j2']) ? $_POST['scoremap1j2'] : "";
    $scoremap2j1 = isset($_POST['scoremap2j1']) && !empty($_POST['scoremap2j1']) ? $_POST['scoremap2j1'] : "";
    $scoremap2j2 = isset($_POST['scoremap2j2']) && !empty($_POST['scoremap2j2']) ? $_POST['scoremap2j2'] : "";
    $scoremap3j1 = isset($_POST['scoremap3j1']) && !empty($_POST['scoremap3j1']) ? $_POST['scoremap3j1'] : "";
    $scoremap3j2 = isset($_POST['scoremap3j2']) && !empty($_POST['scoremap3j2']) ? $_POST['scoremap3j2'] : "";
    $maps = isset($_POST['maps']) && !empty($_POST['maps']) ? explode(',', $_POST['maps']) : "";
    $map1 = !empty($maps) ? $maps[0] : "";
    $map2 =	!empty($maps) ? $maps[1] : "";
    $map3 = !empty($maps) ? $maps[2] : "";
    addNewMatch($idpseudo1, $idpseudo2, $scoremap1j1, $scoremap1j2);
    echo $idpseudo1;
    echo $idpseudo2;
    echo $scoremap1j1;
    echo $scoremap1j2;


?>
