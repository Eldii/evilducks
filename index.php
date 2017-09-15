<?php
require("function.php");
require ('steamauth/steamauth.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Evilducks Team - Quack !</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="img/favicon.png" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">

  <!-- Template styles -->
  <link href="css/style.css" rel="stylesheet">

</head>

<body>
  <?php
  if(isset($_POST) && !empty($_POST)){
    telechargeDemo($_POST);
    //Préparation du header pour le dl
    header('Content-disposition: attachment; filename="demos/download_demo.zip"');
    header('Content-Type: application/force-download');
    header('Content-Transfer-Encoding: application/zip'.'\n'); // Surtout ne pas enlever le \n
    header('Content-Length: '.filesize("demos/download_demo.zip"));
    header("Pragma: no-cache");
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0, public');
    header('Expires: 0');

    // Efface le tampon de sortie IMPORTANT !!!!!!!!!!!!!!!
    ob_clean();

    //téléchargement
    readfile("demos/download_demo.zip");
    unlink("demos/download_demo.zip");
  }
  ?>


  <!--Navbar-->
  <nav class="navbar navbar-toggleable-md navbar-dark scrolling-navbar fixed-top">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#collapseEx2" aria-controls="collapseEx2" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#home">
        <img src="img/evilducks.png" class="d-inline-block align-top z-depth-0 logo" alt="Evilducks">
      </a>
      <div class="collapse navbar-collapse" id="collapseEx2">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href='#home'>Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href='#bootcamp'>BootCamp</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href='#demos'>GOTV</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href='#agenda'>Agenda</a>
          </li> -->
          <!-- <li class="nav-item">
          <a class="nav-link">Pricing</a>
        </li>
        <li class="nav-item btn-group">
        <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <a class="dropdown-item">Action</a>
        <a class="dropdown-item">Another action</a>
        <a class="dropdown-item">Something else here</a>
      </div>
    </li> -->
  </ul>
  <?php
  if(!isset($_SESSION['steamid'])) {
    loginbutton();
  }  else {
    include ('steamauth/userInfo.php');
    // print_r('<p class="nav-link">');
    // print_r($steamprofile);
    // print_r('</p>');
    echo '<div style="color: #fff; padding-right: 1%;">';
    echo '<img src="' . $steamprofile['avatar'] . '" alt="' . $steamprofile['personaname'] . '">';
    echo 'Quack ! ' . $steamprofile['personaname'] . '</div>';
    logoutbutton();
  }?>
</div>
</div>
</nav>
<!--/.Navbar-->

<video autoplay loop id="bgvid">
  <source src="img/background.mp4" type="video/mp4">
  </video>
  <!--Caption-->
  <a  name="home"></a>
  <div class="section carousel-caption active" id="home">
    <div class="flex-center animated fadeInDown">
      <ul>
        <li>
          <h1 class="h1-responsive">Evilcup : tournoi CSGO</h1></li>
          <li>
            <p>Un tournoi réservé exclusivement au membres de la team Evilducks</p>
          </li>
          <li>
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
                    <div class="col-lg-2 col-sm-2 col-xs-1 compteur">
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
                    <div class="col-lg-2 col-sm-2 col-xs-1 compteur">
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
                    <div class="col-lg-2 col-sm-2 col-xs-1 compteur">
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
          </li>
          <li>
            <a href="https://github.com/Eldii/Evilducks/" class="btn github waves-effect"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
            <!-- <a href="" class="btn btn-primary btn-lg">Sign up!</a> -->
            <!-- <a target="_blank" href="https://mdbootstrap.com/material-design-for-bootstrap/" class="btn btn-default btn-lg">Learn more</a> -->
          </li>
        </ul>
      </div>
    </div>
    <!--Caption-->


    <!--Bootcamp-->
    <a  name="bootcamp"></a>
    <div class="carousel-caption section" id="bootcamp">
      <!--Intro content-->
      <div class="full-bg-img flex-center">
        <ul>
          <li>
            <div><?php  echo '
            <p class="compteur_bootcamp">'
            .afficheCompteurBootcamp().
            '</p>'; ?></div></li>
            <li>
              <p>Bootcampomètre ma frend made in YetiErix</p>
            </li>
            <?php
            if(isset($steamprofile['steamid']) && $steamprofile['steamid'] == "76561197987841925"){
              echo '<li>
              <button href="" class="btn btn-primary btn-lg incremente">Incrémenter</button>
              <button href="" class="btn btn-default btn-lg decremente">Décrémenter</button>
              </li>';
            }
            ?>
          </ul>
        </div>
        <!--/Intro content-->
      </div>
      <!--/.Bootcamp-->

      <!--Demos-->
      <a  name="demos"></a>
      <div class="carousel-caption section" id="demos">
        <form method="post" action="">
          <!--Intro content-->
          <div class="full-bg-img flex-center">
            <div class="container">
              <div class="row table_dl">
                <table class="table table_demos" style="text-align: left;">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nom</th>
                      <th>Date (d/m/Y)</th>
                      <th>Taille</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php echo afficheDemo(); ?>
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="col">
                </div>
                <div class="col">
                    <input class="btn btn-warning" type="submit" value="Télécharger les démos">
                </div>
                <div class="col">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!--/.Demos-->

      <!--Agenda-->
      <!-- <a  name="agenda"></a>
      <div class="carousel-caption section container" id="agenda">
        <div class="row" style="height: 90%; padding-top: 10%;">
          <div class="col-md-3 event_agenda">
            <p>Event : Bootcamp
            <hr>
            Date : Bootcamp
            <hr>
            Time : Bootcamp
            <hr>
            Description : Bootcamp </p>
          </div>
          <div class="col-md-1"> </div>
          <div class="col-md-3 event_agenda">
            test
          </div>
          <div class="col-md-1"> </div>
          <div class="col-md-3 event_agenda">
            test
          </div>
      </div>
      </div> -->
      <!--/.Agenda-->


      <!-- SCRIPTS -->

      <!-- JQuery -->
      <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

      <!-- Bootstrap tooltips -->
      <script type="text/javascript" src="js/tether.min.js"></script>

      <!-- Bootstrap core JavaScript -->
      <script type="text/javascript" src="js/bootstrap.min.js"></script>

      <!-- MDB core JavaScript -->
      <script type="text/javascript" src="js/mdb.min.js"></script>

      <!-- script evilducks JavaScript -->
      <script type="text/javascript" src="js/evilducks.js"></script>

      <!-- JsCookie JavaScript -->
      <script type="text/javascript" src="js/jquery.cookie.js"></script>


    </body>

    </html>
