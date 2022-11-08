<?php /** @var $exception */ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404</title>
    <style>
        body {
            background-color: ghostwhite;
        }

        .flex-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 300px;
        }

        .flex-container>div {
            background-color: white;
            color: #333333;
            text-align: center;
            width: 80%;
            height: 100%;
            padding: 15px;
            box-shadow: 2px 2px 5px #999999;
        }
        footer p {
            font-size: small;
            color: #666666;
            vertical-align: bottom;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="flex-container">
                <div style="align-self: center">
                    <header>
                        <h2>Fatal Error</h2>
                    </header>
                    <section>
                        <h4>Message</h4>
                        <p><?php echo $exception['message'] ?></p>
                        <p><?= $exception['code'] ?></p>
                    </section>
                    <footer>
                        <p>You can contact the webmaster at: <a href="mailto:webmaster@localhost">webmaster@localhost</a></p>
                    </footer>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
