<!DOCTYPE html>
<html lang="en">

<section>

    <?php
    require __DIR__ . '/../vendor/autoload.php';
    require_once('template.class.php');
    define('TEMPLATES_PATH', 'templates');

    session_start();
    $client = new GuzzleHttp\Client(['base_uri' => 'https://jsonplaceholder.typicode.com']);
    $res = $client->request('GET', '/users');
    $users = json_decode($res->getBody(), true);
    if (isset($_GET["user"])) {
        $template = new Template(TEMPLATES_PATH . '/user.html');
        $user = $users[$_GET["user"] - 1];
        $template->assign('username',  $user["name"]);
        $template->assign('phone',  $user["phone"]);
        $template->assign('email',  $user["email"]);
        $template->assign('street', $user["address"]["street"]);
        $template->assign('city',  $user["address"]["city"]);
        $template->show();
    } else {
        $template = new Template(TEMPLATES_PATH . '/userListItem.html');

        foreach ($users as $user) {
            
            $template->assign('username',  $user["name"]);
            $template->assign('user_id',  $user["id"]);
            $template->show();
        }

        if (!$_SESSION["logged"]) {
            header("location: login.php");
        }
    }

    ?>
</section>

</html>