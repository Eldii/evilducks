<?php

/**
 * Fonction qui permet de se connecter à la base de données
 *
*/
function connectDB()
{
    $host = "kry.wtf";
    $dbname = "evilcup_dev";
    $username = "evilcup";
    $password = "poneyponey42";
    try {
        $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
    }
    return $bdd;
}

/**
 * Retourne un tableau php trié regroupant les joueurs avec leur temps de jeu
 *
 * @return array
*/
function tempsDeJeu()
{
	$bdd = connectDB();
	$reponse = $bdd->query('SELECT * FROM players');
	$joueurs = array();
	while ($donnees = $reponse->fetch()) {
		if ($donnees["pseudo"] !== "Ahix")
			$joueurs[$donnees["pseudo"]] = $donnees["steam_id64"];
	}
    $tempsdejeu = array();
    foreach ($joueurs as $pseudo => $value) {
        $json_url = "http://api.steampowered.com/IPlayerService/GetRecentlyPlayedGames/v0001/?key=8F25D1AE8072C7EEC4D51A90324B549D&steamid=".$value."&format=json";
        $json = file_get_contents($json_url);
        $data = json_decode($json, true);
        for ($i = 0; $i < count($data['response']['games']); $i++) {
            if ($data['response']['games'][$i]["appid"] == 730) {
                $playtime_2weeks = $data['response']['games'][$i]['playtime_2weeks'];
            }
        }
        $hours = round($playtime_2weeks/60, 1, PHP_ROUND_HALF_UP);
        $tempsdejeu[$pseudo] = $hours;
        arsort($tempsdejeu);
/*	    array_push($tempsdejeu, $pseudo => $hours);*/
    }
    return $tempsdejeu;
}

/**
 * Retourne le tableau des pseudos contenu dans la table "players"
 *
 * @return array
*/
function recupPseudo($joueur)
{
    $bdd = connectDB();
    $reponse = $bdd->query('SELECT * FROM players');
    $players = '<select class="form-control" name="'. $joueur .'">';
    $value = 0;
    while ($donnees = $reponse->fetch()) {
        $players .= '<option value="'. $value .'">'. $donnees['pseudo'] .'</option>';
        $value ++;
    }
    $players .= '</select>';
    return $players;
}
