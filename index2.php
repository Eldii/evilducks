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

	<nav class="navbar navbar-default navbar-fixed-top topnav menu" style="opacity: 0.5;">
		<div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
        <strong><p> Evilducks </p></strong>
      </a>
    </div>
		<div class="collapse navbar-collapse fieldmenu" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right liste">
				<li>
					<a href="#head">Règles</a>
				</li>
				<li>
					<a href="#about">Récompense</a>
				</li>
				<li>
					<a href="#themes">Résultats et Classement</a>
				</li>
				<button type="button" class="btn btn-default navbar-btn">Sign in</button>
				<!-- <li><?php
					if(!isset($_SESSION['steamid'])) {
							loginbutton();
						echo "</div>";
						}  else {
							include ('steamauth/userInfo.php');
							echo $steamprofile['personaname'];
						}?>
				</li> -->
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

				<!-- Nice place to describe your site in a sentence or two -->
				<p><a href="/download/" class="btn btn-default btn-lg">Download template now</a></p>

			</div> <!-- /col -->
		</div> <!-- /row -->

	</div>
</section>

<!-- Second (About) section -->
<section class="section" id="about">
	<div class="container">

		<h2 class="text-center title">About me</h2>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-2">
				<h5><strong>Where's my lorem ipsum?<br></strong></h5>
				<p>Well, here it is: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, ullam, ducimus, eaque, ex autem est dolore illo similique quasi unde sint rerum magnam quod amet iste dolorem ad laudantium molestias enim quibusdam inventore totam fugit eum iusto ratione alias deleniti suscipit modi quis nostrum veniam fugiat debitis officiis impedit ipsum natus ipsa. Doloremque, id, at, corporis, libero laborum architecto mollitia molestiae maxime aut deserunt sed perspiciatis quibusdam praesentium consectetur in sint impedit voluptates! Deleniti, sequi voluptate recusandae facere nostrum?</p>
			</div>
			<div class="col-sm-4">
				<h5><strong>More, more lipsum!<br></strong></h5>
				<p>Tempore, eos, voluptatem minus commodi error aut eaque neque consequuntur optio nesciunt quod quibusdam. Ipsum, voluptatibus, totam, modi perspiciatis repudiandae odio ad possimus molestias culpa optio eaque itaque dicta quod cupiditate reiciendis illo illum aspernatur ducimus praesentium quae porro alias repellat quasi cum fugiat accusamus molestiae exercitationem amet fugit sint eligendi omnis adipisci corrupti. Aspernatur.</p>
				<h5><strong>Author links<br></strong></h5>
				<p><a href="http://be.net/pozhilov9409">Behance</a> / <a href="https://twitter.com/serggg">Twitter</a> / <a href="http://linkedin.com/pozhilov">LinkedIn</a> / <a href="https://www.facebook.com/pozhilov">Facebook</a></p>
			</div>
		</div>
	</div>
</section>

<!-- Third (Works) section -->
<section class="section" id="themes">
	<div class="container">

		<h2 class="text-center title">More Themes</h2>
		<p class="lead text-center">
			Huge thank you to all people who publish<br>
			their photos at <a href="http://unsplash.com">Unsplash</a>, thank you guys!
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

<!-- Fourth (Contact) section -->
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
</body>
</html>
