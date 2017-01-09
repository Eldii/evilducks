<?php
    require("function.php");
    $pseudo1 = isset($_POST['joueur1']) && !empty($_POST['joueur1']) ? $_POST['joueur1'] : "";
    $pseudo2 = isset($_POST['joueur2']) && !empty($_POST['joueur2']) ? $_POST['joueur2'] : "";
    $score1 = (isset($_POST['scoremap1j1']) && !empty($_POST['scoremap1j1'])) && (isset($_POST['scoremap1j2']) && !empty($_POST['scoremap1j2'])) ? $_POST['scoremap1j1'] .'-' .  $_POST['scoremap1j2']: "";
    $score2 = (isset($_POST['scoremap2j1']) && !empty($_POST['scoremap2j1'])) && (isset($_POST['scoremap2j2']) && !empty($_POST['scoremap2j2'])) ? $_POST['scoremap2j1'] .'-' .  $_POST['scoremap2j2']: "";
    $score3 = (isset($_POST['scoremap3j1']) && !empty($_POST['scoremap3j1'])) && (isset($_POST['scoremap3j2']) && !empty($_POST['scoremap3j2'])) ? $_POST['scoremap3j1'] .'-' .  $_POST['scoremap3j2']: "";
    $maps = isset($_POST['maps']) && !empty($_POST['maps']) ? $_POST['maps'] : "";
    $players = recupPseudo();
?>
