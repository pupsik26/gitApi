<?php

// echo '<pre>';
// var_dump ();
// echo '</pre>';
// @require_once('php/db_connection.php');

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Routeam</title>
</head>
<body>
    <div class="container">
        <form method="post" action="" class="form">
            <div class="row mt">
                <div class="col-10">
                    <input type="text" name='data' class="form-control ajax_text" id="formGroupExampleInput" placeholder="">
                </div>
                <div class="col-2">
                    <button id='submit' type="submit" class="btn btn-primary btn_clear">Поиск</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        <div id='content' class="content">
            
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>