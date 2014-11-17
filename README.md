Coderity
===

How to Install

1) Ensure that the Coderity Plugin is installed in app/Plugin/Coderity

2) Dump the following SQL file into your database:
   app/Plugin/Coderity/Config/Schema/schema.sql

3) In your app/Config/bootstrap.php file - at the bottom at the following line:

   CakePlugin::load(array('Coderity' => array('routes' => true)));

4) In app/Config/routes.php comment out the following two lines:

   //Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));

   //Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

5) In app/Config/core.php uncomment the following line:

   Configure::write('Routing.prefixes', array('admin'));

6) Open your Cake Application in your browser and you should see the home page.  Visit:
   yourapplication.com/admin

   To register as an admin user