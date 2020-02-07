<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Minifoot Lincent | <?= $this->fetch('title'); ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->Html->css('foundation.css'); ?>
    <?= $this->Html->css('app.css'); ?>
    <?= $this->Html->css('style.css'); ?>
		<?= $this->fetch('css'); ?>
  </head>
  <body>
    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="#">My Site</a></h1>
        </li>
         <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
      </ul>

      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
          <li class="active"><a href="#">Right Button Active</a></li>
          <li class="has-dropdown">
            <a href="#">Right Button Dropdown</a>
            <ul class="dropdown">
              <li><a href="#">First link in dropdown</a></li>
              <li class="active"><a href="#">Active link in dropdown</a></li>
            </ul>
          </li>
        </ul>

        <!-- Left Nav Section -->
        <ul class="left">
          <li><a href="#">Left Nav Button</a></li>
        </ul>
      </section>
    </nav>



		<nav class="navbar navbar-inverse">
		  <div class="container">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		        <span class="sr-only">MENU</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		     <a class="navbar-brand" href="<?php echo $this->Html->url(array(
               "controller" => "pages",
               "action" => "index"
           )); ?>">Minifoot Lincent
         </a>
		    </div>
		    <div id="navbar" class="collapse navbar-collapse">
		      <ul class="nav navbar-nav">
            <li>
              <a href="<?php echo $this->Html->url(array(
                    "controller" => "pages",
                    "action" => "index"
                )); ?>">
                <i class="fa fa-home"></i> Accueil
              </a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-futbol-o"></i> Résultats <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Division 1</a></li>
                <li><a href="#">Division 2</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-ol"></i> Classements <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li>
                  <a href="<?php echo $this->Html->url(array(
                        "controller" => "rankings",
                        "action" => "classementd1"
                    )); ?>">
                    Division 1
                  </a>
                </li>
                <li>
                  <a href="<?php echo $this->Html->url(array(
                        "controller" => "rankings",
                        "action" => "classementd2"
                    )); ?>">
                    Division 2
                  </a>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-calendar"></i> Calendrier <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Division 1</a></li>
                <li><a href="#">Division 2</a></li>
              </ul>
            </li>
		        <li>
              <a href="<?php echo $this->Html->url(array(
                    "controller" => "teams",
                    "action" => "index"
                )); ?>">
                <i class="fa fa-users"></i> Equipes
              </a>
            </li>
            <li>
              <a href="<?php echo $this->Html->url(array(
                    "controller" => "players",
                    "action" => "index"
                )); ?>">
                <i class="fa fa-user"></i> Joueurs
              </a>
            </li>
            <li>
              <a href="<?php echo $this->Html->url(array(
                  "controller" => "users",
                  "action" => "login"
                )); ?>">
              <i class="fa fa-power-off"></i> Se connecter
             </a>
          </li>
		      </ul>
		    </div><!--/.nav-collapse -->
		  </div>
		</nav>
    <div class="container">
      <h1><?= $this->fetch('title'); ?></h2>
			<?= $this->fetch('content'); ?>
    </div>
    <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'); ?>
    <?= $this->Html->script('vendor/jquery.js'); ?>
    <?= $this->Html->script('vendor/modernizr.js'); ?>
    <?= $this->Html->script('foundation.min.js'); ?>
		<?= $this->fetch('script'); ?>
  </body>
</html>
