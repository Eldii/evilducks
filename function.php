<?php
require("config.php");
setlocale(LC_TIME, "fr_FR");
$bdd = connectDB();

/**
* Fonction qui permet de se connecter à la base de données
*
* @return variable de connection à la DB
*/
function connectDB()
{
  $host = DB_HOST;
  $port = DB_PORT;
  $dbname = DB_NAME;
  $username = DB_USER;
  $password = DB_PASSWORD;
  try {
    $bdd = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
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
    if ($donnees["pseudo"] !== "Ahix" && $donnees["pseudo"] !== "Fedaykin"){
      $joueurs[$donnees["pseudo"]] = $donnees["steam_id64"];
    }
  }
  $tempsdejeu = array();
  foreach ($joueurs as $pseudo => $value) {
    $json_url = "http://api.steampowered.com/IPlayerService/GetRecentlyPlayedGames/v0001/?key=8F25D1AE8072C7EEC4D51A90324B549D&steamid=".$value."&format=json";
    $json = file_get_contents($json_url);
    $data = json_decode($json, true);
    $csgofind = false;
    for ($i = 0; $i < count($data['response']['games']); $i++) {
      if ($data['response']['games'][$i]["appid"] == 730) {
        $playtime_2weeks = $data['response']['games'][$i]['playtime_2weeks'];
        $csgofind = true;
      }
    }
    if(!$csgofind)
      $playtime_2weeks = 0;
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
* Retourne la picklist html avec l'ensemble des noms de maps
* @param string
*
* @return string
*/
function recupMapPickList($numeromap)
{
  global $bdd;
  $reponse = $bdd->prepare('SELECT id, name FROM maps WHERE ? like type');
  $reponse->execute(array($numeromap));
  $maps = '<select class="form-control" name="'. $numeromap .'">';
  while ($donnees = $reponse->fetch()) {
    $maps .= '<option value="'. $donnees['id'] .'">'. $donnees['name'] .'</option>';
  }
  $maps .= '</select>';
  return $maps;
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
function addNewMapResult($idmap, $idjoueur1, $idjoueur2, $score1, $score2)
{
  $score2 = empty($score2) ? intval("0") : $score2;
  $bdd = connectDB();
  $reponse = $bdd->prepare('INSERT INTO map_result VALUES (NULL, :idmap, :idjoueur1, :idjoueur2, :score1, :score2)');
  $reponse->execute(array(
    'idmap' => intval($idmap),
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
  $reponse = $bdd->query('SELECT *, UNIX_TIMESTAMP(date) AS timestamp FROM match_result WHERE UNIX_TIMESTAMP(date) - UNIX_TIMESTAMP(NOW()) <= 604801');
  $pseudos = recupPseudo();
  $tr = "";
  while ($donnees = $reponse->fetch()) {
    # Skip si le match n'est pas de la semaine en cours.
    $week_start = strtotime('last monday');
    if ($donnees['timestamp'] < $week_start)
    continue;
    foreach ($pseudos as $id => $pseudo) {
      if($donnees['player1'] == $id){
        $player1 = $pseudo;
      }
      if($donnees['player2'] == $id){
        $player2 = $pseudo;
      }
    }
    $scoregeneral = afficherScoreGeneral(intval($donnees['map1']), intval($donnees['map2']), intval($donnees['map3']));
    $scoremap1 = explode("-", afficherScoreUneMap(intval($donnees['map1'])));
    $scoremap2 = explode("-", afficherScoreUneMap(intval($donnees['map2'])));
    $scoremap3 = !empty(afficherScoreUneMap(intval($donnees['map3']))) ? explode("-", afficherScoreUneMap(intval($donnees['map3']))) : "";
    $nommap1 = afficherNomMap(intval($donnees['map1']));
    $nommap2 = afficherNomMap(intval($donnees['map2']));
    $nommap3 = !empty($scoremap3) ? afficherNomMap(intval($donnees['map3'])) : "";
    $tr .= '<tr class="match">
    <td>'. $player1 .'</td>
    <td>'. $scoregeneral .'</td>
    <td>'. $player2 .'</td>
    </tr>
    <tr class="details info">
    <td>'. $scoremap1[0] .'</td>
    <td>'. $nommap1 .'</td>
    <td>'. $scoremap1[1] .'</td>
    </tr>
    <tr class="details info">
    <td>'. $scoremap2[0] .'</td>
    <td>'. $nommap2 .'</td>
    <td>'. $scoremap2[1] .'</td>
    </tr>';
    if(!empty($scoremap3)){
      $tr .= '
      <tr class="details info">
      <td>'. $scoremap3[0] .'</td>
      <td>'. $nommap3 .'</td>
      <td>'. $scoremap3[1] .'</td>
      </tr>';
      if(!empty($scoremap3)){
        $tr .= '
        <tr class="details info">
          <td>'. $scoremap3[0] .'</td>
          <td>'. $nommap3 .'</td>
          <td>'. $scoremap3[1] .'</td>
        </tr>';
      }
    }
  }
  return $tr;
}

/**
* Retourne le nom d'une map
*
* @param id de la map
* @return string
*/
function afficherNomMap($map)
{
  global $bdd;
  $reponse = $bdd->prepare('SELECT maps.name as map FROM map_result, maps WHERE map_result.map like maps.id AND map_result.id like ?');
  $reponse->execute(array(intval($map)));
  while ($donnees = $reponse->fetch()) {
    $nommap = $donnees['map'];
  }
  return $nommap;
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

      $sql_query = $bdd->prepare("SELECT * FROM map_result WHERE id = :map_id");
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
    // On check si le joueur n'as pas effectué un seul match
    if($score == -1){
      echo '<tr>
      <td>' . $pseudo . '</td>
      <td> N/A </td>
      </tr>';
    }else{ // Sinon on affiche son nombre de point avec son pseudo
      echo '<tr>
      <td>' . $pseudo . '</td>
      <td>' . $score .'</td>
      </tr>';
    }
  }
}

/**
* Fonction qui retourne le compteur du bootcampomètre
*
*/
function afficheCompteurBootcamp()
{
  global $bdd;
  $sql_query = $bdd->prepare('SELECT compteur FROM bootcamp');
  $sql_query->execute();
  $compteur = $sql_query->fetch();
  return $compteur['compteur'];
}


/**
* Fonction qui incrémente le compteur du bootcampomètre
*
*/
function incrementeBootcamp()
{
  global $bdd;
  $bdd->exec('UPDATE bootcamp SET compteur = compteur + 1');
}

/**
* Fonction qui décremente le compteur du bootcampomètre
*
*/
function decrementeBootcamp()
{
  global $bdd;
  $bdd->exec('UPDATE bootcamp SET compteur = compteur - 1');
}

/**
* Fonction qui affiche le tableau des démos
*
*/
function afficheDemo()
{
  $chemin_demo = "demos/";
  $tab_demo = scandir($chemin_demo);
  for($i = 0; $i < count($tab_demo); $i++){
    $demo = $tab_demo[$i];
    $ext = explode('.', $demo);
    $ext = end($ext);
    if($ext !== "dem"){
      unset($tab_demo[$i]);
    }
  }
  $compteur = 0;
  $td_table= "";
  foreach($tab_demo as $demo){
    $td_table .= '<tr>
    <th scope="row">'. $compteur .'</th>
    <td>'. $demo .'</td>
    <td>'. date("d/m/Y", filemtime($chemin_demo.$demo)) .'</td>
    <td>'. affiche_taille(filesize($chemin_demo.$demo)) .'</td>
    <td>
    <fieldset class="form-group">
    <input name="demo_coche'. $compteur .'" value="'. $chemin_demo.$demo .'" type="checkbox">
    </fieldset>
    </td>
    </td>';
    $compteur++;
  }
  return $td_table;
}

/**
* Fonction qui telecharge l'ensemble des démos cochés au préalable
*
*/
function archiveDemo($demos){
  // Création du fichier temporaire
  $_SESSION['tmp_file'] = tempnam("tmp", "zip");
  // Création de l'archive
  if(count($demos) > 1){
    $zip = new ZipArchive();
    if($zip->open($_SESSION['tmp_file'], ZIPARCHIVE::CREATE) !== true) {
      $traitement = FALSE;
    }
    else {
      // On stocke les démos séléctionnés dans l'archive
      foreach($demos as $demo){
        $zip->addFile($demo, iconv('ISO-8859-1', 'IBM850', $demo));
        $zip->setCompressionName($demo, ZIPARCHIVE::CM_STORE);
      }
      $zip->close();
    }
  }
}

/**
 * Lance le téléchargement de démos (compresse toutes les démos dans un zip si il y en a plus d'une)
 *
*/
function telechargeDemo($demos){
  if(count($demos) > 1){
    // http headers for downloads
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename='demos_evilducks.zip'");
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".filesize($_SESSION['tmp_file']));

    if ($fd = fopen ($_SESSION['tmp_file'], "r")) {

            set_time_limit(0);
            ini_set('memory_limit', '1024M');
            // Efface le tampon de sortie IMPORTANT !!!!!!!!!!!!!!!
            ob_clean();
            flush();
        while(!feof($fd)) {
            echo fread($fd, 4096);
        }
    }
    ob_end_flush();
    unlink($_SESSION['tmp_file']); // delete du fichier temporaire
    exit();
  }else{
    $demo = array_pop($demos);
    $nom = explode('/', $demo)[1];
    $poids = filesize($demo);
    // http headers for downloads
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"".$nom."\"");
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$poids);

    if ($fd = fopen ($demo, "r")) {

            set_time_limit(0);
            ini_set('memory_limit', '1024M');
            // Efface le tampon de sortie IMPORTANT !!!!!!!!!!!!!!!
            ob_clean();
            flush();
        while(!feof($fd)) {
            echo fread($fd, 4096);
        }
    }
    ob_end_flush();
    exit();
  }

}

/**
 * Affiche la taille d'un fichier et la met forme
 *
 * @param int $taille Taille du fichier en octet
 *
 * @return int
*/
function affiche_taille($taille) {
	// $taille = intval($taille);
	// $taille = (int)$taille;
	// si le fichier à une taille supérieur à 2147483647, je le laisse en string car php ne lit pas les entiers plus lourd que 2147483647
	$taille = ($taille < 2147483647) ? (int)$taille : $taille;
	if ($taille<1024) { //octets
		return number_format($taille, 0, ',', ' ').' octets';
	}
	else if ($taille < (1024*1024)) { //Ko
		return number_format($taille/1024, 0, ',', ' ').' Ko';
	}
	else { //Mo
		return number_format($taille/(1024*1024), 0, ',', ' ').' Mo';
	}
}
