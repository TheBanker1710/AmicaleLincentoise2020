<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'days', 'action' => 'home', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */

  	Router::connect('/', array('controller' => 'days', 'action' => 'home'));
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'index'));


	/* RANKINGS */

	Router::connect('/classement', array('controller' => 'rankings', 'action' => 'index'));


	/* DAYS - RESULTS */
	
	Router::connect('/resultats', array('controller' => 'days', 'action' => 'results'));	
	Router::connect(
	    '/resultats/resultat/:id', // E.g. /blog/3-CakePHP_Rocks
	    array('controller' => 'days', 'action' => 'result'),
	    array(
	        // order matters since this will simply map ":id" to $articleId in your action
	        'pass' => array('id'),
	        'id' => '[0-9]+'
	    )
	);
	Router::connect(
	    '/resultats/ajouter-scores/:id', // E.g. /blog/3-CakePHP_Rocks
	    array('controller' => 'days', 'action' => 'setresultsperday'),
	    array(
	        // order matters since this will simply map ":id" to $articleId in your action
	        'pass' => array('id'),
	        'id' => '[0-9]+'
	    )
	);


	/* DAYS - CALENDAR */

	Router::connect('/calendrier', array('controller' => 'days', 'action' => 'index'));
	Router::connect(
	    '/calendrier/journee/:id', // E.g. /blog/3-CakePHP_Rocks
	    array('controller' => 'days', 'action' => 'day'),
	    array(
	        // order matters since this will simply map ":id" to $articleId in your action
	        'pass' => array('id'),
	        'id' => '[0-9]+'
	    )
	);
	Router::connect('/calendrier/ajouter-journee', array('controller' => 'days', 'action' => 'addday'));
	Router::connect(
	    '/calendrier/modifier-journee/:id', // E.g. /blog/3-CakePHP_Rocks
	    array('controller' => 'days', 'action' => 'updateday'),
	    array(
	        // order matters since this will simply map ":id" to $articleId in your action
	        'pass' => array('id'),
	        'id' => '[0-9]+'
	    )
	);
	Router::connect(
	    '/calendrier/supprimer-journee/:id', // E.g. /blog/3-CakePHP_Rocks
	    array('controller' => 'days', 'action' => 'deleteday'),
	    array(
	        // order matters since this will simply map ":id" to $articleId in your action
	        'pass' => array('id'),
	        'id' => '[0-9]+'
	    )
	);
	Router::connect(
	    '/calendrier/activer-journee/:id', // E.g. /blog/3-CakePHP_Rocks
	    array('controller' => 'days', 'action' => 'activeday'),
	    array(
	        // order matters since this will simply map ":id" to $articleId in your action
	        'pass' => array('id'),
	        'id' => '[0-9]+'
	    )
	);
	Router::connect('/liste/journees', array('controller' => 'days', 'action' => 'listing'));
	Router::connect(
	    '/calendrier/voir-journee/:id', // E.g. /blog/3-CakePHP_Rocks
	    array('controller' => 'days', 'action' => 'dayview'),
	    array(
	        // order matters since this will simply map ":id" to $articleId in your action
	        'pass' => array('id'),
	        'id' => '[0-9]+'
	    )
	);


	/* TEAMS */

	Router::connect('/equipes', array('controller' => 'teams', 'action' => 'index'));
	Router::connect('/equipes/gestion-equipes', array('controller' => 'teams', 'action' => 'manageteams'));
	Router::connect('/equipes/ajouter-equipe', array('controller' => 'teams', 'action' => 'addteam'));
	Router::connect(
		'/equipes/modifier-equipe/:id-:slug', // E.g. /blog/3-CakePHP_Rocks
	    array('controller' => 'teams', 'action' => 'editteam'),
	    array(
	        // order matters since this will simply map ":id" to $articleId in your action
	        'pass' => array('id', 'slug'),
	        'id' => '[0-9]+'
	    )
	);
	Router::connect(
	    '/equipes/equipe/:id-:slug', // E.g. /blog/3-CakePHP_Rocks
	    array('controller' => 'teams', 'action' => 'team'),
	    array(
	        // order matters since this will simply map ":id" to $articleId in your action
	        'pass' => array('id', 'slug'),
	        'id' => '[0-9]+'
	    )
	);
	Router::connect(
	    '/equipes/information/:id-:slug', // E.g. /blog/3-CakePHP_Rocks
	    array('controller' => 'teams', 'action' => 'information'),
	    array(
	        // order matters since this will simply map ":id" to $articleId in your action
	        'pass' => array('id', 'slug'),
	        'id' => '[0-9]+'
	    )
	);
	Router::connect(
	    '/equipes/supprimer-equipe/:id-:slug', // E.g. /blog/3-CakePHP_Rocks
	    array('controller' => 'teams', 'action' => 'deleteteam'),
	    array(
	        // order matters since this will simply map ":id" to $articleId in your action
	        'pass' => array('id', 'slug'),
	        'id' => '[0-9]+'
	    )
	);


	/* PLAYERS */

	Router::connect('/joueurs', array('controller' => 'players', 'action' => 'index'));
	Router::connect(
	    '/joueurs/joueur/:id-:slug', // E.g. /blog/3-CakePHP_Rocks
	    array('controller' => 'players', 'action' => 'player'),
	    array(
	        // order matters since this will simply map ":id" to $articleId in your action
	        'pass' => array('id', 'slug'),
	        'id' => '[0-9]+'
	    )
	);
	Router::connect('/joueurs/ajouter-joueur', array('controller' => 'players', 'action' => 'addplayer'));
	Router::connect(
	    '/joueurs/modifier-joueur/:id-:slug', // E.g. /blog/3-CakePHP_Rocks
	    array('controller' => 'players', 'action' => 'editplayer'),
	    array(
	        // order matters since this will simply map ":id" to $articleId in your action
	        'pass' => array('id', 'slug'),
	        'id' => '[0-9]+'
	    )
	);
	Router::connect(
	    '/joueurs/liste/:search', // E.g. /blog/3-CakePHP_Rocks
	    array('controller' => 'players', 'action' => 'playerslist'),
	    array(
	        // order matters since this will simply map ":id" to $articleId in your action
	        'pass' => array('search')	        
	    )
	);
	Router::connect(
	    '/joueurs/supprimer-joueur/:id-:slug', // E.g. /blog/3-CakePHP_Rocks
	    array('controller' => 'players', 'action' => 'deleteplayer'),
	    array(
	        // order matters since this will simply map ":id" to $articleId in your action
	        'pass' => array('id', 'slug'),
	        'id' => '[0-9]+'
	    )
	);


	/* CARDS */
	Router::connect('/cartes', array('controller' => 'cards', 'action' => 'index'));
	Router::connect(
	    '/joueurs/ajouter-carte/:id-:slug', // E.g. /blog/3-CakePHP_Rocks
	    array('controller' => 'cards', 'action' => 'addcard'),
	    array(
	        // order matters since this will simply map ":id" to $articleId in your action
	        'pass' => array('id', 'slug'),
	        'id' => '[0-9]+'
	    )
	);	


	/* CHAMPIONSHIPS */

	Router::connect('/championnat/parametres', array('controller' => 'championships', 'action' => 'index'));


	/* USERS */

	Router::connect('/utilisateurs/connexion', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/utilisateurs/deconnexion', array('controller' => 'users', 'action' => 'logout'));
	Router::connect('/utilisateurs', array('controller' => 'users', 'action' => 'index'));
	Router::connect('/utilisateurs/ajouter-utilisateur', array('controller' => 'users', 'action' => 'register'));
	Router::connect(
	    '/utilisateurs/utilisateur/:id', // E.g. /blog/3-CakePHP_Rocks
	    array('controller' => 'users', 'action' => 'user'),
	    array(
	        // order matters since this will simply map ":id" to $articleId in your action
	        'pass' => array('id'),
	        'id' => '[0-9]+'
	    )
	);
	Router::connect(
	    '/utilisateurs/modifier-utilisateur/:id', // E.g. /blog/3-CakePHP_Rocks
	    array('controller' => 'users', 'action' => 'edit'),
	    array(
	        // order matters since this will simply map ":id" to $articleId in your action
	        'pass' => array('id'),
	        'id' => '[0-9]+'
	    )
	);

	/* API */

	Router::mapResources('apis');
	Router::parseExtensions();


/**
 * Load all plugin routes.  See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
