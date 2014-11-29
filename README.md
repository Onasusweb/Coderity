Coderity
===

How to Install

1) Ensure that the Coderity Plugin is installed in app/Plugin/Coderity

   The easiest way to do this, is in your terminal / command line, go to your app/Plugin directory and run the following command:
   git submodule add https://github.com/coderity/Coderity.git

2) Dump the following SQL file into your database:
   app/Plugin/Coderity/Config/Schema/schema.sql

3) In your app/Config/bootstrap.php file - at the bottom at the following line:

   CakePlugin::load(array('Coderity' => array('routes' => true, 'bootstrap' => true)));

4) In app/Config/routes.php comment out the following two lines:

   //Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));

   //Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

5) Open your Cake Application in your browser and you should see the home page.  Visit:
   yourapplication.com/admin

   To register an admin user and install Coderity

6) Finally, by default your local app/View/Layouts/default.ctp file will load.
   If this is a new application, you can copy the default Coderity layout file from:
   app/Plugin/Coderity/View/Layout/default.ctp.default to:
   app/View/Layout/default.ctp

   If this is an existing application, you can see how the top and bottom menu is loaded at: app/Plugin/Coderity/View/Layout/default.ctp.default

   To load the top menu, simply insert:
   <?php echo $this->element('Coderity.menu'); ?>

   Or for the bottom menu insert:
   <?php echo $this->element('Coderity.menu', array('type' => 'bottom')); ?>

To view the full documentation, visit: http://www.coderity.com/docs