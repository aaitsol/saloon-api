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
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
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
	//Router::connect('/', array('controller' => 'admins', 'action' => 'dashboard', 'admin'=>true));

	Router::connect('/', array('controller' => 'pages', 'action' => 'home'));
	Router::connect('/affilate/*', array('controller' => 'users', 'action' => 'get_affilates'));
	
	Router::connect('/page/:slug', array('controller' => 'pages', 'action' => 'view', 'slug'=>'[a-zA-Z-_0-9]+'));
	 // App::import('Lib', 'Route/PageRoute');
	// Router::connect('/:slug', array('controller' => 'pages', 'action' => 'view'), array('routeClass' => 'PageRoute')); 
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	
	Router::connect('/admin', array('admin' => true, 'controller' => 'admins', 'action' => 'login'));
	Router::connect('/login', array('user' => true, 'controller' => 'users', 'action' => 'login'));
	Router::connect('/dashboard', array('user' => true, 'controller' => 'users', 'action' => 'dashboard'));
	
	Router::connect('/videos', array('controller' => 'feeds', 'action' => 'videos'));
	//Router::parseExtensions();
	Router::parseExtensions('rss');
	/*public profile portfolio*/
	/* Router::connect('/port/view/*', array('controller' => 'portfolios', 'action' => 'public_portfolio')); */

	// Router::connect('/stripe/get_response', array('stripe' => true, 'controller'=>'users','action'=>'payment_info'));

/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
