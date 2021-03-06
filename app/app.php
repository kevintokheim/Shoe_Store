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

    //Delete all stores
    $app->post('/delete_stores', function() use ($app) {
        $GLOBALS['DB']->exec("DELETE FROM stores;");
        Store::deleteAll();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
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

    //Add a brand to a store's individual page
    $app->post('/individual_store/{id}/add_brand', function($id) use($app) {
        $find_store = Store::find($id);
        $brand_name = $_POST['brand_name'];
        $new_brand = new Brand($brand_name);
        $new_brand->save();
        $find_store->addBrand($new_brand);
        $brands = $find_store->getBrands();
        return $app['twig']->render('store.html.twig', array('store' => $find_store, 'brands' => $brands));
    });

    //Update store info
    //Is only changing URL, not the store name itself
    $app->patch("/individual_store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->update($_POST['store_name']);
        $brands = $store->getBrands();
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $brands));
    });


    //Delete store info
    //Method not Allowed
    $app->delete("/individual_store{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    //Individual Brand Page
    $app->get("/brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $stores = $brand->getStores();
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $stores));
    });

    //Add a store to the brand page
    $app->post("/brand/{id}/add_store", function($id) use ($app) {
        $find_brand = Brand::find($id);
        $store_name = $_POST['store_name'];
        $new_store = new Store($store_name);
        $new_store->save();
        $find_brand->addStore($new_store);
        $stores = $find_brand->getStores();
        return $app['twig']->render('brand.html.twig', array('brand' => $find_brand, 'stores' => $stores));
    });

    return $app;



























?>
