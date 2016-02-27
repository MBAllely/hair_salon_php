<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";


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

    $app->get("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        var_dump($stylist);
        $clients = $stylist->getClients();

        return $app['twig']->render('stylists.html.twig', array(
            'stylist' => $stylist,
            'clients' => $clients
        ));
    });

    $app->get("/stylists/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $clients = Client::find($id);

        return $app['twig']->render('stylists_edit.html.twig', array(
            'stylist' => $stylist,
            'clients' => $clients
        ));
    });

    $app->patch("/stylists/{id}", function($id) use ($app) {
        $new_name = $_POST['new_name'];
        $stylist = Stylist::find($id);
        $stylist->updateStylist($new_name);

        $clients = Client::find($id);

        return $app['twig']->render('stylists.html.twig', array(
            'stylist' => $stylist,
            'clients' => $clients
        ));
    });

    $app->post("/stylists/{id}/delete", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->deleteStylist();

        return $app['twig']->render('stylists_edit.html.twig', array(
            'stylist' => $stylist
        ));
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


    $app->post("/clients/{stylist_id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $client_name = $_POST('client_name');
        $phone = $_POST('phone');
        $stylist_id = $stylist->getId();
        $new_client = new Client($client_name, $phone, $stylist_id);
        $new_client->save();
        return $app['twig']->render('stylists.html.twig', array(
            'stylist' => $stylist,
            'clients' => Stylist::getClients()
        ));
    });


    return $app;
?>
