<?php
$bdd = $bdd = connectDB();
/**
 * Fonction qui permet de se connecter à la base de données
 *
 * @return variable de connection à la DB
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
 * Retourne un tableau php trié regroupant les joueurs en fonction de leur temps de jeu
 *
 * @return array
*/
function tempsDeJeu()
{
	global $bdd;
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
/*        array_push($tempsdejeu, $pseudo => $hours);*/
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
    global $bdd;
    $reponse = $bdd->query('SELECT * FROM players');
    $players = '<select class="form-control" name="'. $joueur .'">';
    $value = 1;
    while ($donnees = $reponse->fetch()) {
        $players .= '<option value="'. $value .'">'. $donnees['pseudo'] .'</option>';
        $value++;
    }
    $players .= '</select>';
    return $players;
}

/**
 * Retourne le tableau (de type id => pseudo) de l'ensemble des joueurs de l'équipe
 *
 * @return array
*/
function recupPseudo()
{
    global $bdd;
    $reponse = $bdd->query('SELECT * FROM players');
    $players = array();
    while ($donnees = $reponse->fetch()) {
        $players[$donnees['id']] = $donnees['pseudo'];
    }
    return $players;
}

/**
 * Ajoute un nouveau match dans la base de données
 *
 * @return int id resultat de la map inséré
*/
function addNewMapResult($idjoueur1, $idjoueur2, $score1, $score2)
{
    $score2 = empty($score2) ? intval("0") : $score2;
    $bdd = connectDB();
    $reponse = $bdd->prepare('INSERT INTO map_result VALUES (NULL, 1, :idjoueur1, :idjoueur2, :score1, :score2)');
    $reponse->execute(array(
    'idjoueur1' => intval($idjoueur1),
    'idjoueur2' => intval($idjoueur2),
    'score1' => intval($score1),
    'score2' => intval($score2)
    ));
    $lastid = $bdd->lastInsertId();
    return $lastid;
}

/**
 * Ajoute un nouveau match dans la base de données
 *
*/
function addNewMatch($type, $idjoueur1, $idjoueur2, $map1, $map2, $map3)
{
    global $bdd;
    $reponse = $bdd->prepare('INSERT INTO match_result VALUES (NULL, :type, :idjoueur1, :idjoueur2, :score1, :score2, :score3, :datejoue)');
    $reponse->execute(array(
    'type' => $type,
    'idjoueur1' => intval($idjoueur1),
    'idjoueur2' => intval($idjoueur2),
    'score1' => intval($map1),
    'score2' => intval($map2),
    'score3' => $map3,
    'datejoue' => date("Y-m-d")
    ));
}

/**
 * Retourne le tableau html avec l'ensemble des résultats de match
 *
 * @return array
*/
function resultatsMatchs()
{
    global $bdd;
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
      $score = afficherScoreGeneral(intval($donnees['map1']), intval($donnees['map2']), intval($donnees['map3']));
      echo '<tr>
        <td>'. $player1 .'</td>
        <td>'. $player2 .'</td>
        <td>'. $score .'</td>
      </tr>';
    }
}

/**
 * Retourne le score d'une seul map
 *
 * @return string
*/
function afficherScoreUneMap($map)
{
    global $bdd;
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
    $scoremap2 = !empty($map2) ? explode('-', afficherScoreUneMap($map2)) : "";
    $scoremap3 = !empty($map3) ? explode('-', afficherScoreUneMap($map3)) : "";

    $scorej1 = 0;
    $scorej2 = 0;

    $scoremap1[0] > $scoremap1[1] ? $scorej1++ : $scorej2++;
    if(!empty($scoremap2)){
      $scoremap2[0] > $scoremap2[1] ? $scorej1++ : $scorej2++;
    }
    if(!empty($scoremap3)){
      $scoremap3[0] > $scoremap3[1] ? $scorej1++ : $scorej2++;
    }

    return $scorej1 . '-' . $scorej2;
}

/**
 * Retourne le pseudo d'un joueur en partant de son id
 *
 * @return string
*/
function playerIdToNick($bdd, $id)
{

    $sql_query = $bdd->prepare("SELECT id, pseudo FROM players WHERE id = :id");
    $sql_query->bindParam(':id', $id);
    $sql_query->execute();
    $pseudo = $sql_query->fetch();
    return $pseudo['pseudo'];
}

/**
 * Retourne un array correspondant au classement de la semaine. -1 = n'as jamais joué cette semaine.
 *
 * @return array
*/
function ranking()
{
    global $bdd;
    $rankings = array();

    $players = $bdd->query('SELECT * FROM players');
    while ($data = $players->fetch(PDO::FETCH_ASSOC)) {
        $rankings[$data['pseudo']] = -1;
    }

    $match_result = $bdd->query(
        'SELECT *, UNIX_TIMESTAMP(date) AS timestamp FROM match_result WHERE UNIX_TIMESTAMP(date) - UNIX_TIMESTAMP(NOW()) <= 604801'
    );
    while ($data = $match_result->fetch(PDO::FETCH_ASSOC)) {

        # Skip si le match n'est pas de la semaine en cours.
        $week_start = strtotime('last monday');
        if ($data['timestamp'] < $week_start)
            continue;

        $pseudo1 = playerIdToNick($bdd, $data['player1']);
        $pseudo2 = playerIdToNick($bdd, $data['player2']);

        # Hax pour voir que les joueurs ont joué même s'ils n'ont pas de points.
        if ($rankings[$pseudo1] <= -1)
            $rankings[$pseudo1] = 0;
        if ($rankings[$pseudo2] <= -1)
            $rankings[$pseudo2] = 0;

        for ($x = 1; $x <= 3; $x++) {
            # On stop la boucle dès qu'on trouve une map à NULL
            if (!$data["map$x"])
                break ;

            $sql_query = $bdd->prepare(
                "SELECT match_result.id, match_result.map1, map_result.id, map_result.score_p1, map_result.score_p2 FROM match_result, map_result WHERE match_result.id = :match_id AND match_result.map1 = :map_id"
            );
            $sql_query->bindParam(':match_id', $data['id']);
            $sql_query->bindParam(':map_id', $data["map$x"]);
            $sql_query->execute();
            $map = $sql_query->fetch();

            if ($map['score_p1'] > $map['score_p2'])
                $rankings[$pseudo1]++;
            else
                $rankings[$pseudo2]++;
        }
    }
    return $rankings;
}

/**
 * Affiche le classement de chaque joueur ayant participer au tournoi
 *
*/
function afficherClassement()
{
    $classement = ranking();
    arsort($classement);
      foreach($classement as $pseudo => $score){
        echo '<tr>
          <td>' . $pseudo . '</td>
          <td>' . $score .'</td>
        </tr>';
      }
}
