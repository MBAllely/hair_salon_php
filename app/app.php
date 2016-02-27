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


    $app->post("/clients", function() use ($app) {
        $client_name = $_POST['client_name'];
        $phone = $_POST['phone'];
        $stylist_id = $_POST['stylist_id'];
        $new_client = new Client($client_name, $phone, $stylist_id);
        $new_client->save();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('stylists.html.twig', array(
            'stylist' => $stylist,
            'clients' => $stylist->getClients()
        ));
    });

    $app->get("/clients/{id}/edit", function($id) use ($app) {
        $client = Client::find($id);
        return $app['twig']->render('clients_edit.html.twig', array(
           'client' => $client
       ));
    });

    $app->patch("/clients/{id}/edit", function($id) use ($app) {
        $client = Client::find($id);
        $new_client_name = $_POST['new_client_name'];
        $new_phone = $_POST['new_phone'];
        $stylist_id = $client->getStylistId();
        $client->updateClient($new_client_name, $new_phone);
        $stylist = Stylist::find($stylist_id);
        $clients = $stylist->getClients();
        return $app['twig']->render('stylists.html.twig', array(
            'stylist' => $stylist,
            'clients' => $clients
        ));
    });

    $app->delete("/clients/{id}/delete", function($id) use ($app) {
        $client = Client::find($id);
        $stylist_id = $client->getStylistId();
        $stylist = Stylist::find($stylist_id);
        $client->deleteOneClient();
        return $app['twig']->render('stylists.html.twig', array(
            'stylist' => $stylist,
            'clients' => $stylist->getClients()
        ));
    });

    return $app;
?>
