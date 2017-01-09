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
 * Retourne la picklist html avec l'ensemble des pseudos des joueurs
 * @param string
 *
 * @return string
*/
function recupPseudoPickList($joueur)
{
    $bdd = connectDB();
    $reponse = $bdd->query('SELECT * FROM players');
    $players = '<select class="form-control" name="'. $joueur .'">';
    $value = 1;
    while ($donnees = $reponse->fetch()) {
        $players .= '<option value="'. $value .'">'. $donnees['pseudo'] .'</option>';
        $value ++;
    }
    $players .= '</select>';
    return $players;
}

/**
 * Ajoute un nouveau match dans la base de données
 *
 * @return int
*/
function addNewMatch($idjoueur1, $idjoueur2, $score1, $score2)
{
    $bdd = connectDB();
    $reponse = $bdd->prepare('INSERT INTO map_result VALUES (NULL, 1, :idjoueur1, :idjoueur2, :score1, :score2)');
    $reponse->execute(array(
    'idjoueur1' => intval($idjoueur1),
    'idjoueur2' => intval($idjoueur2),
    'score1' => intval($score1),
    'score2' => intval($score2)
    ));
    echo "add";
}

/**
 * Retourne le tableau de l'ensemble de joueurs de l'équipe
 *
 * @return array
*/
function recupPseudo()
{
    $bdd = connectDB();
    $reponse = $bdd->query('SELECT * FROM players');
    $players = array();
    while ($donnees = $reponse->fetch()) {
        $players[$donnees['id']] = $donnees['pseudo'];
    }
    return $players;
}

/**
 * Retourne le tableau html avec l'ensemble des résultats de match
 *
 * @return array
*/
function resultatsMatchs()
{
    $bdd = connectDB();
    $reponse = $bdd->query('SELECT * FROM match_result');
    $pseudos = recupPseudo();
    while ($donnees = $reponse->fetch()) {
      foreach ($pseudos as $id => $pseudo) {
        if($donnees['player1'] == $id){
          $player1 = $pseudo;
        }
        if($donnees['player2'] == $id){
          $player2 = $pseudo;
        }
      }
      echo '<tr>
        <td>'. $player1 .'</td>
        <td>'. $player2 .'</td>
        <td>'. afficherScoreGeneral(intval($donnees['map1']), intval($donnees['map2']), intval($donnees['map3'])) .'</td>
      </tr>';
    }
}

/**
 * Retourne le score d'une seul map
 *
 * @return array
*/
function afficherScoreUneMap($map)
{
    $bdd = connectDB();
    $reponse = $bdd->prepare('SELECT score_p1, score_p2 FROM map_result WHERE id = ?');
    $reponse->execute(array(intval($map)));
    while ($donnees = $reponse->fetch()) {
        $scoremap = $donnees['score_p1'] . '-' . $donnees['score_p2'];
    }
    if(isset($scoremap)){
      return $scoremap;
    }
}

/**
 * Retourne le socre de l'ensemble d'un match
 *
 * @return array
*/
function afficherScoreGeneral($map1, $map2, $map3)
{
    $scoremap1 = explode('-', afficherScoreUneMap($map1));
    $scoremap2 = explode('-', afficherScoreUneMap($map2));
    $scoremap3 = explode('-', afficherScoreUneMap($map3));

    if(scoremap1[0] > scoremap1[1] && scoremap2[0] > scoremap2[1]){
      echo "2-0";
    }elseif(scoremap1[0] < scoremap1[1] && scoremap2[0] < scoremap2[1]){
      echo "0-2";
    }

    if(scoremap1[0] > scoremap1[1] && scoremap2[0] < scoremap2[1] && scoremap3[0] < scoremap3[1])


    var_dump($scoremap1);
}
