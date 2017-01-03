<?php

/**
 * Retourne un tableau php trié regroupant les joueurs avec leur temps de jeu
 * 
 * @return array
*/
function tempsdejeu() {
	$joueurs = IDSteam();
	$tempsdejeu = array();
	foreach($joueurs as $pseudo => $value){
		$json_url = "http://api.steampowered.com/IPlayerService/GetRecentlyPlayedGames/v0001/?key=8F25D1AE8072C7EEC4D51A90324B549D&steamid=".$value."&format=json";
	    $json = file_get_contents($json_url);
	    $data = json_decode($json, TRUE);
	    for($i = 0; $i < count($data['response']['games']); $i++){
	    	if($data['response']['games'][$i]["appid"] == 730){
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
 * Retourne un tableau php regroupant l'ensemble des IDSteam des joueurs de l'équipe
 * 
 * @return array
*/
function IDSteam() {
	$joueurs = array(
		"Ld" => "76561198110002164",
		"kRYOoX" => "76561197996849793",
		"Lipton" => "76561198062663788",
		"Fedaykin" => "76561197961467303",
		"YetiEric" => "76561197987841925"
	);
	return $joueurs;
}

?>
