<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
    $plugin = 'coderity';

    Router::connect('/', array('plugin' => $plugin, 'controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
    Router::connect('/admin', array('plugin' => $plugin, 'admin' => true, 'controller' => 'users', 'action' => 'home'));

/**
 * And some other rules for the Coderity Plugin
 */
    Router::connect('/article/*', array('plugin' => $plugin, 'controller' => 'articles', 'action' => 'view'));

    $controllers = array('pages', 'users', 'articles', 'users', 'settings', 'leads', 'redirects');
    foreach ($controllers as $controller) {
        Router::connect('/' . $controller, array('plugin' => $plugin, 'controller' => $controller));
        Router::connect('/' . $controller . '/:action', array('plugin' => $plugin, 'controller' => $controller, 'action' => ':action'));
        Router::connect('/' . $controller . '/:action/*', array('plugin' => $plugin, 'controller' => $controller, 'action' => ':action'));

        Router::connect('/admin/' . $controller, array('plugin' => $plugin, 'admin' => true, 'controller' => $controller));
        Router::connect('/admin/' . $controller . '/:action', array('plugin' => $plugin, 'admin' => true, 'controller' => $controller, 'action' => ':action'));
        Router::connect('/admin/' . $controller . '/:action/*', array('plugin' => $plugin, 'admin' => true, 'controller' => $controller, 'action' => ':action'));
    }

/**
 * This is an optional route - feel free to remove it if not required
 * It will automatically allow you to use /about rather than /page/about which can be useful
 * best used when their are not too many other controllers, as exceptions need to be made
*/
    if (Configure::read('Coderity.routes.autoRouting')) {
        $ignore = 'add|view|display|delete|admin|users|leads|blog';
        if (Configure::read('Coderity.routes.autoRoutingIgnoreRoutes')) {
            $ignore = Configure::read('Coderity.routes.autoRoutingIgnoreRoutes');
        }

        Router::connect('/:route', array('plugin' => $plugin, 'controller' => 'pages', 'action' => 'display'),
        array(
            'route' => '(?!' . $ignore . '\b)\b[a-zA-Z0-9_-]+',
            'pass'=>array('route')
        ));
    }
