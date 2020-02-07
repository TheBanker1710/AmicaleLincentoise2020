<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>L'amicale lincentoise | <?= $this->fetch('title'); ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'); ?>
    <?= $this->Html->css('foundation.css'); ?>
    <?= $this->Html->css('app.css'); ?>
    <?= $this->Html->css('style.css'); ?>
    <?= $this->fetch('css'); ?>
    <link rel="shortcut icon" href="<?php echo Router::url('/'); ?>app/webroot/img/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">   
  </head>
  <body id="body">
  <div class="contain-to-grid">
    <nav class="top-bar large-centered" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">          
          <a href="<?php echo $this->Html->url(array(
                "controller" => "days",
                "action" => "home"
            )); ?>">
                <div class="fa-logo"><i class="fa fa-futbol-o"></i></div>
                <div class="logo-title">l'amicale lincentoise</div><!--<img src="/minifoot-lincent/app/webroot/img/logo-minifoot-lincent.png" alt="Minifoot Lincent"/>-->
          </a>        
        </li>
         <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span><!--Menu--></span></a></li>
      </ul>
      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul>
          <li>
            <a href="<?php echo $this->Html->url(array(
                  "controller" => "days",
                  "action" => "home"
              )); ?>"><i class="fa fa-home"></i> Accueil</a>
          </li>
          <li class="has-dropdown">
            <a href="#"><i class="fa fa-futbol-o" aria-hidden="true"></i> Division 1</a>
            <ul class="dropdown">
              <li>
                <a href="<?php echo $this->Html->url(array(
                      "controller" => "days",
                      "action" => "results"
                  )); ?>">
                  <i class="fa fa-list-ul"></i> Résultats
                </a>
              </li>
              <li>
                <a href="<?php echo $this->Html->url(array(
                      "controller" => "rankings",
                      "action" => "index"
                  )); ?>">
                  <i class="fa fa-list-ol"></i> Classement
                </a>
              </li>
            </ul>
          </li>          
          <?php
            if($this->Session->read('Auth.User.role') == "admin" || $this->Session->read('Auth.User.role') == "user"){
          ?>
          <li class="has-dropdown">
            <a href="#"><i class="fa fa-calendar"></i> Calendrier</a>
            <ul class="dropdown">
              <li>
                <a href="<?php echo $this->Html->url(array(
                      "controller" => "days",
                      "action" => "index"
                  )); ?>"><i class="fa fa-list-ul"></i> Liste des journées D1</a>
              </li>
              <li>
                <a href="<?php echo $this->Html->url(array(
                      "controller" => "days",
                      "action" => "addday"
                  )); ?>"><i class="fa fa-plus"></i> Ajouter une journée D1</a>
              </li>              
            </ul>
          </li>
          <?php
            }else{
          ?>
          <li>
            <a href="<?php echo $this->Html->url(array(
                  "controller" => "days",
                  "action" => "index"
              )); ?>"><i class="fa fa-calendar"></i> Calendrier</a>
          </li>
          <li>
            <a href="<?php echo $this->Html->url(array(
                  "controller" => "cards",
                  "action" => "index"
              )); ?>"><i class="fa fa-square"></i> Cartes</a>
          </li>
          <?php
            }
            if($this->Session->read('Auth.User.role') == "admin" || $this->Session->read('Auth.User.role') == "user"){
          ?>
          <li class="has-dropdown">
            <a href="#"><i class="fa fa-users"></i> Equipes</a>
            <ul class="dropdown">
              <li>
                <a href="<?php echo $this->Html->url(array(
                      "controller" => "teams",
                      "action" => "manageteams"
                  )); ?>"><i class="fa fa-list-ul"></i> Liste des équipes D1</a>
              </li>             
              <li>
                <a href="<?php echo $this->Html->url(array(
                      "controller" => "teams",
                      "action" => "addteam"
                  )); ?>"><i class="fa fa-plus"></i> Ajouter une équipe</a>
              </li>
              <li>
                <a href="<?php echo $this->Html->url(array(
                      "controller" => "players",
                      "action" => "index"
                  )); ?>"><i class="fa fa-list-ul"></i> Liste des joueurs</a>
              </li> 
              <li>
                <a href="<?php echo $this->Html->url(array(
                      "controller" => "players",
                      "action" => "addplayer"
                  )); ?>"><i class="fa fa-plus"></i> Ajouter un joueur</a>
              </li>
            </ul>
          </li>      
          <li>
            <a href="<?php echo $this->Html->url(array(
                  "controller" => "cards",
                  "action" => "index"
              )); ?>"><i class="fa fa-square"></i> Cartes</a>
          </li>    
          <li class="has-dropdown">
            <a href="#"><i class="fa fa-info"></i> Informations</a>
            <ul class="dropdown">
              <li>
                <a href="<?php echo $this->Html->url(array(
                    "controller" => "contacts",
                    "action" => "index"
                  )); ?>">
                <i class="fa fa-phone" aria-hidden="true"></i> Contact
               </a>
              </li>
              <li>
                <a href="http://mathieulancelle.be/amicale-lincentoise/documents/reglement-amicale-lincentoise-2016-2017.pdf" target="_blank">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>  Règlement 2016-2017
               </a>
              </li>                 
              <li>
                <a href="http://mathieulancelle.be/amicale-lincentoise/documents/affiliation-joueur-amicale-lincentoise.pdf" target="_blank">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>  Formulaire affiliation joueur
               </a>
              </li>               
            </ul>
          </li>
          <li class="has-dropdown">
              <a href="#"><i class="fa fa-user"></i> <?php echo $this->Session->read('Auth.User.firstname') ." (".$this->Session->read('Auth.User.role').")"; ?></a>
              <ul class="dropdown"> 
                  <li>
                    <a href="<?php echo $this->Html->url(array(
                          "controller" => "users",
                          "action" => "index"
                        )); ?>">
                      <i class="fa fa-list-ul"></i> Liste des utilisateurs
                    </a>
                  </li>
                  <?php
                    if($this->Session->read('Auth.User.role') == "admin"){
                  ?>
                  <li>
                    <a href="<?php echo $this->Html->url(array(
                        "controller" => "users",
                        "action" => "register"
                      )); ?>">
                    <i class="fa fa-plus"></i> Ajouter un utilisateur
                    </a>
                  </li> 
                  <li>
                    <a href="<?php echo $this->Html->url(array(
                        "controller" => "championships",
                        "action" => "index"
                      )); ?>">
                    <i class="fa fa-cogs"></i> Gestion du championnat
                    </a>
                  </li> 
                  <?php
                    }
                  ?>            
                  <li>
                      <a href="<?php echo $this->Html->url(array(
                          "controller" => "users",
                          "action" => "logout"
                        )); ?>">
                      <i class="fa fa-power-off"></i> Se déconnecter
                      </a>
                  </li>
              </ul>
          </li>
          <?php
            }else{
          ?>
            <li class="has-dropdown">
              <a href="#"><i class="fa fa-info"></i> Informations</a>
              <ul class="dropdown">
                <li>
                  <a href="<?php echo $this->Html->url(array(
                      "controller" => "contacts",
                      "action" => "index"
                    )); ?>">
                  <i class="fa fa-phone" aria-hidden="true"></i> Contact
                 </a>
                </li>
                <li>
                  <a href="http://mathieulancelle.be/amicale-lincentoise/documents/reglement-amicale-lincentoise-2016-2017.pdf" target="_blank">
                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Règlement 2016-2017
                 </a>
                </li>                 
                <li>
                  <a href="http://mathieulancelle.be/amicale-lincentoise/documents/affiliation-joueur-amicale-lincentoise.pdf" target="_blank">
                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>  Formulaire affiliation joueur
                 </a>
                </li>               
              </ul>
            </li>
            <?php
              } 

              if($this->Session->read('Auth.User') && $this->Session->read('Auth.User.role') == "arbitre"){
            ?>
            <li class="has-dropdown">
              <a href="#"><i class="fa fa-user"></i> <?php echo $this->Session->read('Auth.User.firstname') ." (".$this->Session->read('Auth.User.role').")"; ?></a>
              <ul class="dropdown">                           
                  <li>
                      <a href="<?php echo $this->Html->url(array(
                          "controller" => "users",
                          "action" => "logout"
                        )); ?>">
                      <i class="fa fa-power-off"></i> Se déconnecter
                      </a>
                  </li>
              </ul>
            </li> 
            <?php
              }else{
                if($this->Session->read('Auth.User') && ($this->Session->read('Auth.User.role') == "admin" || $this->Session->read('Auth.User.role') == "user")){

                }else{

            ?>
            <li>
              <a href="<?php echo $this->Html->url(array(
                    "controller" => "users",
                    "action" => "login"
                  )); ?>">
                <i class="fa fa-power-off"></i> Se connecter
               </a>
            </li>
          <?php
              }
            }
          ?>
        </ul>
      </section>
    </nav>
  </div>
  <div class="container">
    <div class="row">
      <div class="large-12 columns">
        <div class="container">
          <h1>Erreur 404</h1>
          <p>Oups! La page que vous avez demandé n'existe pas.</p>
        </div>          
      </div>
    </div>
  </div>
  <script type="text/javascript">
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-44546651-1', 'mathieulancelle.be');
    ga('send', 'pageview');
  </script>
    <?= $this->Html->script('vendor/jquery.js'); ?>
    <?= $this->Html->script('foundation.min.js'); ?>
    <?= $this->Html->script('app.js'); ?>
    <?= $this->fetch('script'); ?>
     <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script>
      jQuery(document).ready(function(){
            $(document).foundation();
      });
    </script>
  </body>
</html>