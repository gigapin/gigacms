<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>500</title>
    <style>
        #main {
            max-width: 600px;
            margin: auto;
            background-color: cornsilk;
            padding: 5px;
        }
        section {
            background-color: azure;
        }
    </style>
</head>
<body>
<div id="main">
    <?php /** @var $exception */ ?>
    <header>
        <h2>500 Internal Server Error</h2>
        <h3>Uncaught exception <?= $exception['exception'] ?></h3>
    </header>
    <section>
        <h4>Message</h4>
        <p><?php echo $exception['message'] ?></p>
        <h4>Stack Trace</h4>
        <p><?= $exception['trace'] ?></p>
        <p>Thrown in <?= $exception['file']  ?> on line <?= $exception['line'] ?></p>
    </section>
    <footer></footer>
</div>
</body>
</html>
