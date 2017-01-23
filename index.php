<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Evilducks Team - Quack !</title>


  <!-- Favicon -->
  <link rel="icon" type="image/jpg" href="img/favicon.jpg" />

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/landing-page.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/accueil.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>
  <?php
  require("function.php");
  ?>

  <!-- Navigation -->
  <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
    <div class="container topnav">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand topnav" href="#">Evilducks</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="#regles">Règles</a>
          </li>
          <li>
            <a href="#recompenses">Récompense</a>
          </li>
          <li>
            <a href="#resultats">Résultats et Classement</a>
          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
  </nav>

  <!-- Header -->
  <div class="intro-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="intro-message">
            <h1>Tournoi CSGO</h1>
            <h3>Un tournoi réservé exclusivement au membres de la team Evilducks</h3>
            <hr class="intro-divider">
            <ul class="list-inline intro-social-buttons">
              <li>
                <a href="https://github.com/Eldii/Evilducks/" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
              </li>
            </ul>
            <div class="box">
              <a class="button" data-toggle="modal" data-target="#squarespaceModal">Nouveau match</a>
            </div>
            <div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel">Rentrez un nouveau résultat</h3>
                  </div>
                  <div class="modal-body">

                    <!-- content goes here -->
                    <form action="traitement_match.php" method="post">
                      <div class="form-group">
                        <label for="joueur1">Joueur 1:</label>
                        <?php
                        $pseudos = recupPseudoPickList('joueur1');
                        echo $pseudos;
                        ?>
                      </div>
                      <div class="form-group">
                        <label for="joueur2">Joueur 2:</label>
                        <?php
                        $pseudos = recupPseudoPickList('joueur2');
                        echo $pseudos;
                        ?>
                      </div>
                      <div class="form-group">
                        <div class="container">
                          <div class="row">
                            <div class="col-lg-2 col-sm-3">
                          <label class="libellemap">Map 1 :</label>
                              <input type="text" class="form-control score" style="display:inline;" name="scoremap1j1" id="scorejoueur1" placeholder="16" required>
                              <input type="text" class="form-control score" style="display:inline;" name="scoremap1j2" id="scorejoueur1" placeholder="0" required>
                              <br/>
                              <br/>
                              <?php echo recupMapPickList("aim") ?>
                            </div>
                            <div class="col-lg-2 col-sm-3">
                          <label class="libellemap">Map 2 :</label>
                              <input type="text" class="form-control score" style="display:inline;" name="scoremap2j1" id="scorejoueur1" placeholder="16" required>
                              <input type="text" class="form-control score" style="display:inline;" name="scoremap2j2" id="scorejoueur1" placeholder="0" required>
                              <br/>
                              <br/>
                              <?php echo recupMapPickList("awp") ?>
                            </div>
                              <div class="col-lg-2 col-sm-3">
                          <label class="libellemap">Map 3 :</label>
                              <input type="text" class="form-control score" style="display:inline;" name="scoremap3j1" id="scorejoueur1" placeholder="0">
                              <input type="text" class="form-control score" style="display:inline;" name="scoremap3j2" id="scorejoueur1" placeholder="0">
                              <br/>
                              <br/>
                              <?php echo recupMapPickList("pistol") ?>
                            </div>
                            </div>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-default">Submit</button>
                    </form>

                  </div>
                </div>
              </div>
            </div>
            <!-- <ul class="list-inline intro-social-buttons">
            <li>
            <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
          </li>
          <li>
          <a href="#" class="btn btn-default btn-lg"><i class="fa fa-linkedin fa-fw"></i> <span class="network-name">Linkedin</span></a>
        </li>
      </ul> -->
    </div>
  </div>
</div>

</div>
<!-- /.container -->

</div>
<!-- /.intro-header -->

<!-- Page Content -->

<a  name="regles"></a>
<div class="content-section-a">

  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-sm-6">
        <hr class="section-heading-spacer">
        <div class="clearfix"></div>
        <h2 class="section-heading">Les règles</h2>
        <p class="lead">Les règles du jeu sont très simple le but est de gagner le plus de match contre l'ensemble des joueurs de l'équipe. <br/>Chaque semaine les joueurs de la team des vilains canards (Coach et last compris) s'inscrivent au tournoi sur le site. <br/> Les matchs sont définis par des BO3 (Aim map, Awp Map et Pistol Map). Le gagnant du BO3 remporte 3 points dans le classement. <br/><br/>Arrangez vous comme vous voulez pour jouer ces matchs, le mieux serait de les faire avant les matchs de 21h pour être bien chaud le soir par exemple.</p>
      </div>
      <div class="col-lg-5 col-lg-offset-2 col-sm-6">
        <img class="img-responsive" src="img/rules.png" alt="">
      </div>
    </div>

  </div>
  <!-- /.container -->

</div>
<!-- /.content-section-a -->

<a  name="recompenses"></a>
<div class="content-section-b">

  <div class="container">

    <div class="row">
      <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
        <hr class="section-heading-spacer">
        <div class="clearfix"></div>
        <h2 class="section-heading">La récompense</h2>
        <p class="lead">Le premier du classement gagne le droit de ne pas seek de toute la semaine. Les récompenses évolueront au fur et à mesure si je/on trouve des meilleures idées :D.</p>
      </div>
      <div class="col-lg-5 col-sm-pull-6  col-sm-6">
        <img class="img-responsive" src="img/recompense.png" alt="">
      </div>
    </div>

  </div>
  <!-- /.container -->

</div>
<!-- /.content-section-b -->
<a  name="resultats"></a>
<div class="content-section-a">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-sm-6">
        <hr class="section-heading-spacer">
        <div class="clearfix"></div>
        <h2 class="section-heading">Matchs de la semaine</h2>
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
  								<th>Pseudo2</th>
  								<th>Score</th>
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
      <div class="col-lg-5 col-lg-offset-2 col-sm-6">
        <hr class="section-heading-spacer">
        <div class="clearfix"></div>
        <h2 class="section-heading">Classement général</h2>
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

  </div>
  <div class="content-section-c">
    <h1 style="text-align: center;"> Nombre d'heures joués les 15 derniers jours (noob shaming au dernier) </h1>

    <div class="container">

      <div class="row">
        <?php
        $tempsdejeu = tempsdejeu();
        $premiereCle = current($tempsdejeu);
        end($tempsdejeu);
        $derniereCle = key($tempsdejeu);
        foreach ($tempsdejeu as $pseudo => $hours) {
          if ($pseudo == $derniereCle) {
            echo '
            <div class="col-lg-2 col-sm-6 compteur">
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
            <div class="col-lg-2 col-sm-6 compteur">
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
            <div class="col-lg-2 col-sm-6 compteur">
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
  <!-- /.content-section-a -->

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <ul class="list-inline">
            <li>
              <a href="#">Home</a>
            </li>
            <li class="footer-menu-divider">&sdot;</li>
            <li>
              <a href="#regles">Règles</a>
            </li>
            <li class="footer-menu-divider">&sdot;</li>
            <li>
              <a href="#recompense">Récompense</a>
            </li>
            <li class="footer-menu-divider">&sdot;</li>
            <li>
              <a href="#resultats">Résultats et Classement</a>
            </li>
          </ul>
          <p class="copyright text-muted small">Copyright &copy; Evilducks 2017. All Rights Reserved</p>
        </div>
      </div>
    </div>
  </footer>

</body>

</html>
