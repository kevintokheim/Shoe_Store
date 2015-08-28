<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();



    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));


    //HOME PAGE
    $app->get('/', function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    //STORE PAGE - shows a list of stores and their brands,
    //and displays a button to allow the user to add a store.
    $app->get('/stores', function() use ($app) {
        $stores = Store::getAll();
        $brands = Brand::getAll();
        return $app['twig']->render("stores.html.twig", array('stores' => $stores, 'brands' => $brands));
    });

    //Adds a store to the page after the user clicks the "add" button
    $app->post('/store_added', function() use ($app) {
        $store = new Store($_POST['store_name']);
        $store->save();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    //Renders the indiviual store page when a user clicks on a store
    $app->get('/individual_store/{id}', function($id) use ($app) {
        $store = Store::find($id);
        $store_brands = $store->getBrands();
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store_brands));
    });


    return $app;



























?>
