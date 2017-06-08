<?php require("function.php"); ?>
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
            <a class="nav-link" href='#resultats'>Resultats</a>
          </li>
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
        <form class="form-inline waves-effect waves-light">
          <input class="form-control" type="text" placeholder="Search">
        </form>
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
              <a target="_blank" href="https://mdbootstrap.com/getting-started/" class="btn btn-primary btn-lg">Sign up!</a>
              <a target="_blank" href="https://mdbootstrap.com/material-design-for-bootstrap/" class="btn btn-default btn-lg">Learn more</a>
            </li>
          </ul>
        </div>
      </div>
      <!--Caption-->


      <!--Mask-->
      <a  name="resultats"></a>
      <div class="carousel-caption section" id="resultats">
        <!--Intro content-->
        <div class="full-bg-img flex-center">
          <ul>
            <li>
              <h1 class="h1-responsive">Material Design for Bootstrap 4</h1></li>
              <li>
                <p>The most powerful and free UI KIT for Bootstrap</p>
              </li>
              <li>
                <a target="_blank" href="https://mdbootstrap.com/getting-started/" class="btn btn-primary btn-lg">Sign up!</a>
                <a target="_blank" href="https://mdbootstrap.com/material-design-for-bootstrap/" class="btn btn-default btn-lg">Learn more</a>
              </li>
            </ul>
          </div>
          <!--/Intro content-->
        </div>
        <!--/.Mask-->


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
