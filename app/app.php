<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";


    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array(
            'stylists' => Stylist::getAll()
        ));
    });

    $app->get("/stylists{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        // $clients = Client::find($id);

        return $app['twig']->render('stylists.html.twig', array(
            'stylist' => $stylist,
            // 'clients' = $clients
        ));
        //YOU STOPPED HERE! RENDER YOUR PAGE, FUCK WITH IT UNTIL IT WORKS, AND THEN START ADDING DELETE/UPDATE BUTTONS.

        //NEXT: ADD THE CLIENT CLASS
    });

    $app->post("/stylists", function() use ($app) {
        $stylist = new Stylist($_POST['name']);
        $stylist->save();
        return $app['twig']->render('index.html.twig',
        array(
            'stylists' => Stylist::getAll()
        ));
    });

    $app->post("/delete_stylists", function() use ($app) {
        Stylist::deleteAll();
        return $app['twig']->render('index.html.twig', array(
            'stylists' => Stylist::getAll()
        ));
    });

    return $app;
?>
