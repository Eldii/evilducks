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
	$map1 = isset($_POST['aim']) && !empty($_POST['aim']) ? $_POST['aim'] : "";
	$map2 =	isset($_POST['awp']) && !empty($_POST['awp']) ? $_POST['awp'] : "";
	$map3 = isset($_POST['pistol']) && !empty($_POST['pistol']) ? $_POST['pistol'] : "";
	// on récupère l'id des nouvelles map result qui ont été crée auparavant
	$idmap1 = addNewMapResult($map1, $idpseudo1, $idpseudo2, $scoremap1j1, $scoremap1j2);
	$idmap2 = addNewMapResult($map2, $idpseudo1, $idpseudo2, $scoremap2j1, $scoremap2j2);
	$idmap3 = !empty($scoremap3j1) && !empty($scoremap3j2) ? addNewMapResult($map3, $idpseudo1, $idpseudo2, $scoremap3j1, $scoremap3j2) : NULL;
	// Et on les envoie à la fonction d'ajout de match
	addNewMatch("bo3", $idpseudo1, $idpseudo2, $idmap1, $idmap2, $idmap3);
	header('Location: index.php#resultats'); // On renvoie l'utilisateur sur la page index.php sur la partie des resultats de matchs
?>
