<?php
    require ('steamauth/steamauth.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">

	<title>Evilducks Team - Quack !</title>

	<!-- Favicon -->
  <link rel="icon" type="image/jpg" href="img/favicon.jpg" />

	<!-- Bootstrap itself -->
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" type="text/css">

	<!-- Custom styles -->
	<link rel="stylesheet" href="assets/css/magister.css">
	<link href="css/landing-page.css" rel="stylesheet">

	<!-- Fonts -->
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Wire+One' rel='stylesheet' type='text/css'>
</head>

<!-- use "theme-invert" class on bright backgrounds, also try "text-shadows" class -->
<body class="theme-invert" onload="background_reload()">
	<?php
  require("function.php");
  ?>

	<nav class="navbar navbar-default topnav menu" style="opacity: 0.5;">
		<div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#head">
        <strong><p> Evilducks </p></strong>
      </a>
    </div>
		<div class="collapse navbar-collapse fieldmenu" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right liste">
				<li>
					<a href="#regles">Règles</a>
				</li>
				<li>
					<a href="#recompenses">Récompense</a>
				</li>
				<li>
					<a href="#resultats">Résultats et Classement</a>
				</li>
        <li>
					<a href="#themes">Vidéo Youtube</a>
				</li>
        <li>
					<a href="#bootcamp">BootCampoMètre</a>
				</li>
				<!-- <button type="button" class="btn btn-default navbar-btn">Sign in</button> -->
				<li><?php
					if(!isset($_SESSION['steamid'])) {
							loginbutton();
						echo "</div>";
						}  else {
							include ('steamauth/userInfo.php');
							echo $steamprofile['personaname'];
						}?>
				</li>
			</ul>
		</div>
  </div>
	</nav>

<!-- <nav class="mainmenu">
	<div class="container">
		<div class="dropdown">
			<button type="button" class="navbar-toggle" data-toggle="dropdown"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
				<li><a href="#head" class="active">Hello</a></li>
				<li><a href="#about">About me</a></li>
				<li><a href="#themes">Themes</a></li>
				<li><a href="#contact">Get in touch</a></li>
			</ul>
		</div>
	</div>
</nav> -->


<!-- Main (Home) section -->
<section class="section" id="head">
	<div class="container">

		<div class="row">
			<div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1 text-center">

				<!-- Site Title, your name, HELLO msg, etc. -->
				<h1 class="title">Tournoi CSGO</h1>
				<h2 class="subtitle">Un tournoi réservé exclusivement au membres de la team Evilducks</h2>

				<!-- Short introductory (optional) -->
				<div class="content-section-c">
					<div class="container compteurheures">

			      <div class="row">
			        <?php
			        $tempsdejeu = tempsdejeu();
			        $premiereCle = current($tempsdejeu);
			        end($tempsdejeu);
			        $derniereCle = key($tempsdejeu);
			        foreach ($tempsdejeu as $pseudo => $hours) {
			          if ($pseudo == $derniereCle) {
			            echo '
			            <div class="col-lg-2 col-sm-5 compteur">
			            <h2 class="pseudo">'.$pseudo.'</h2>
			            <div class="lastcircle">
			            <p class="heures">'
			            .$hours.
			            '</p><br /> <br /> <br />
			            <p class="heurestexte"> Heures </p>
			            </div>
			            </div>';
			          } elseif ($hours == $premiereCle) {
			            echo '
			            <div class="col-lg-2 col-sm-5 compteur">
			            <h2 class="pseudo">'.$pseudo.'</h2>
			            <div class="firstcircle">
			            <p class="heures">'
			            .$hours.
			            '</p><br /> <br /> <br />
			            <p class="heurestexte"> Heures </p>
			            </div>
			            </div>';
			          } else {
			            echo '
			            <div class="col-lg-2 col-sm-5 compteur">
			            <h2 class="pseudo">'.$pseudo.'</h2>
			            <div class="circle multi-line">
			            <p class="heures">'
			            .$hours.
			            '</p><br /> <br /> <br />
			            <p class="heurestexte"> Heures </p>
			            </div>
			            </div>';
			          }
			        }
			        ?>
			      </div>
			    </div>
			    <!-- /.container -->

			  </div>

				<!-- Nice place to describe your site in a sentence or two -->
        <br/>
        <ul class="list-inline intro-social-buttons">
          <li>
            <a href="https://github.com/Eldii/Evilducks/" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
          </li>
        </ul>

			</div> <!-- /col -->
		</div> <!-- /row -->

	</div>
</section>

<!-- Second (About) section -->
<section class="section" id="recompenses">
	<div class="container">

		<h2 class="text-center title">Recompenses</h2>
    <div class="row">
			<div class="col-sm-4 col-sm-offset-2">
        <img class="img-responsive" src="img/recompense.png" alt="">
			</div>
			<div class="col-sm-4">
        <div class="clearfix"></div>
        <p class="lead">Le premier du classement gagne le droit de ne pas seek de toute la semaine. Les récompenses évolueront au fur et à mesure si je/on trouve des meilleures idées :D.</p>
			</div>
		</div>
	</div>
</section>

<!-- Third (Regles) section -->
<section class="section" id="regles">
	<div class="container">

		<h2 class="text-center title">Règles de la cup</h2>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-2">
        <img class="img-responsive" src="img/rules.png" alt="">
			</div>
			<div class="col-sm-4">
        <h2 class="section-heading">Les règles</h2>
        <p class="lead">Les règles du jeu sont très simple le but est de gagner le plus de match contre l'ensemble des joueurs de l'équipe. <br/>Chaque semaine les joueurs de la team des vilains canards (Coach et last compris) s'inscrivent au tournoi sur le site. <br/> Les matchs sont définis par des BO3 (Aim map, Awp Map et Pistol Map). Le gagnant du BO3 remporte 3 points dans le classement. <br/><br/>Arrangez vous comme vous voulez pour jouer ces matchs, le mieux serait de les faire avant les matchs de 21h pour être bien chaud le soir par exemple.</p>
			</div>
		</div>
	</div>
</section>

<!-- Fourth (Resultats) section -->
<section class="section" id="resultats">
	<div class="container">

		<h2 class="text-center title">Resultats</h2>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <br/>
            <div class="pull-right">
              <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                <i class="glyphicon glyphicon-filter"></i>
              </span>
            </div>
          </div>
          <div class="panel-body">
            <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Chercher un joueur" />
          </div>
          <?php
          $rankings = ranking();
          $matchsjoue = 0;
          foreach($rankings as $pseudo => $score){
                if($score == -1){
                  $matchsjoue++;
                }
          }
          if($matchsjoue == count($rankings)){
            echo "<p> Aucun match n'a été joué </p>";
          }else{
            echo'
            <table class="table table-hover" id="dev-table">
              <thead>
                <tr>
                  <th>Pseudo1</th>
                  <th>Score</th>
                  <th>Pseudo2</th>
                </tr>
              </thead>
              <tbody>'.
                resultatsMatchs()
              .'</tbody>
            </table>
            ';
            // echo '<table class="table">
            //   <thead>
            //     <tr>
            //       <th>Pseudo1</th>
            //       <th>Pseudo2</th>
            //       <th>Score</th>
            //     </tr>
            //   </thead>
            //   <tbody>'.
            //     resultatsMatchs()
            //   .'</tbody>
            // </table>';
          }
            ?>
        </div>
			</div>
			<div class="col-sm-4">
        <div class="clearfix"></div>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Pseudo</th>
              <th>Points</th
              </tr>
            </thead>
            <tbody>
              <?php
              afficherClassement();
              ?>
            </tbody>
          </table>
			</div>
		</div>
	</div>
</section>

<!-- Fifth (Works) section -->
<section class="section" id="themes">
	<div class="container">

		<h2 class="text-center title">Chaîne EvilDucks</h2>
		<p class="lead text-center">
			Bienvenue sur la chaîne evilducks ici vous pouvez voir toutes les vidéos posté sur la chaîne youtube de l'équipe<br>
			Rdv à cette adresse pour allez directement sur la chaîne youtube <a href="https://www.youtube.com/channel/UCQ6rxG5fVR24FAp1NOdEppQ">Evilducks</a>
		</p>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-2">
				<div class="thumbnail">
					<img src="assets/screenshots/sshot1.jpg" alt="">
					<div class="caption">
						<h3>Thumbnail label</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque doloribus enim vitae nam cupiditate eius at explicabo eaque facere iste.</p>
						<p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="thumbnail">
					<img src="assets/screenshots/sshot4.jpg" alt="">
					<div class="caption">
						<h3>Thumbnail label</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque doloribus enim vitae nam cupiditate eius at explicabo eaque facere iste.</p>
						<p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
					</div>
				</div>
			</div>
			<div class="col-sm-4 col-sm-offset-2">
				<div class="thumbnail">
					<img src="assets/screenshots/sshot5.jpg" alt="">
					<div class="caption">
						<h3>Thumbnail label</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque doloribus enim vitae nam cupiditate eius at explicabo eaque facere iste.</p>
						<p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="thumbnail">
					<img src="assets/screenshots/sshot3.jpg" alt="">
					<div class="caption">
						<h3>Thumbnail label</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque doloribus enim vitae nam cupiditate eius at explicabo eaque facere iste.</p>
						<p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
					</div>
				</div>
			</div>

		</div>

	</div>
</section>

<!-- Fifth (Works) section -->
<section class="section" id="bootcamp">
	<div class="container">
    <h2 class="text-center title">BootCampoMètre</h2>
    <figure>
    <img class="background_bootcamp" src="img/bootcampometre.png" alt="BootCampoMètre de Yeti Erix"/>
    <figcaption><h2 class="compteur_bootcamp">5</h2>    <button type="button" class="btn btn-primary incremente">Primary</button>
        <button type="button" class="btn btn-primary decremente">Primary</button></figcaption>
  </figure>
	</div>
</section>

<!-- Sixth (Contact) section -->
<section class="section" id="contact">
	<div class="container">

		<h2 class="text-center title">Get in touch</h2>

		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 text-center">
				<p class="lead">Have a question about this template, or want to suggest a new feature?</p>
				<p>Feel free to email me, or drop me a line in Twitter!</p>
				<p><b>gt@gettemplate.com</b><br><br></p>
				<ul class="list-inline list-social">
					<li><a href="https://twitter.com/serggg" class="btn btn-link"><i class="fa fa-twitter fa-fw"></i> Twitter</a></li>
					<li><a href="https://github.com/pozhilov" class="btn btn-link"><i class="fa fa-github fa-fw"></i> Github</a></li>
					<li><a href="http://linkedin/in/pozhilov" class="btn btn-link"><i class="fa fa-linkedin fa-fw"></i> LinkedIn</a></li>
				</ul>
			</div>
		</div>

	</div>
</section>


<!-- Load js libs only when the page is loaded. -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="assets/js/modernizr.custom.72241.js"></script>
<!-- Custom template scripts -->
<script src="assets/js/magister.js"></script>
<script src="js/accueil.js"></script>
</body>
</html>
