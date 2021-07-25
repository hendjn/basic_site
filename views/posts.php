<!DOCTYPE html>
<html lang="en">

<section>

    <?php
    require __DIR__ . '/../vendor/autoload.php';
    require_once('template.class.php');
    define('TEMPLATES_PATH', 'templates');
    session_start();
    $client = new GuzzleHttp\Client(['base_uri' => 'https://jsonplaceholder.typicode.com']);
    $res = $client->request('GET', '/posts');
    $posts = json_decode($res->getBody(), true);
    $res = $client->request('GET', '/users');
    $users = json_decode($res->getBody(), true);
    if (isset($_GET["post"])) {
        $template = new Template(TEMPLATES_PATH . '/post.html');

        $user = current(array_filter($users, function ($item) {
            global $posts;
            return $item["id"] == $posts[$_GET["post"] - 1]["userId"];
        }));
        $post = $posts[$_GET["post"] - 1];
        $template->assign('username', $user["name"]);
        $template->assign('USER_ID', $user["id"]);
        $template->assign('title', $post["title"]);
        $template->assign('content', $post["body"]);
        $template->show();
    } else {
        $template = new Template(TEMPLATES_PATH . '/postListItem.html');
        foreach ($posts as $post) {
            $href = 'href=".?post=' . $post["id"];
            $user = current(array_filter($users, function ($item) {
                global $post;
                return $item["id"] == $post["userId"];
            }));
            $template->assign('username', $user["name"]);
            $template->assign('user_id', $user["id"]);
            $template->assign('title', $post["title"]);
            $template->assign('post_id', $post["id"]);
            $template->assign('sub_content', substr($post["body"], 0, 20));
            $template->show();
          
        }

        if (!$_SESSION["logged"]) {
            header("location: login.php");
        }
    }

    ?>
</section>

</html>