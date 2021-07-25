<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Document</title>
</head>

<body class="bg-light">
    <?php include 'header.php';
    require __DIR__ . '/vendor/autoload.php';
    $client = new GuzzleHttp\Client(['base_uri' => 'https://jsonplaceholder.typicode.com']);
    $res = $client->request('GET', '/users');
    $users = json_decode($res->getBody(), true);
    $user = current(array_filter($users, function ($item) {
        return $item["id"] == 7;
    }));
    ?>
    <div class=" main-div">
        <div class="container" style="max-width:90%">
            <div class="row">
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="card ">
                        <div class="card-header">About you</div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <img src="static/images/profile_photo.jpg" class="avatar" alt="Avatar">
                                </div>
                                <div class="col-lg-8">
                                    <h5 class="card-title"><?php echo $user["name"] ?></h5>
                                    <p style=" color: rgb(133, 133, 133);"><i>“It’s not whether you get knocked down, it’s whether you get up.”</i></p>
                                </div>
                            </div>
                            
                            <p class="card-text">
                            <dl>
                            <dt><b>Contact Info:</b></dt>
                            <dd>Phone: <i> <?php echo $user["phone"] ?> </i></dd>
                            <dd> Email: <i><?php echo $user["email"] ?> </i></dd>
                            <dt><b>Address:</b></dt>
                            <dd>Street: <i><?php echo $user["address"]["street"] ?></i></dd>
                            <dd>City: <i><?php echo $user["address"]["city"] ?></i></dd>
                            </dl>

                            </p>

                        </div>
                    </div>
                </div>
                <div class='col-9' style="padding-left:40px">

                    <?php
                    include($child)

                    ?>
                </div>

            </div>
        </div>
    </div>
    <?php include 'footer.php' ?>
</body>

</html>