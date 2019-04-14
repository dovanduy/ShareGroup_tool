<?php
//function run(){
//
//    $r = [];
//    for ($i = 1; $i < 10; $i++) {
//       $r[] = $i;
//    }
//
//    return $r;
//}
//
//if (isset($_POST['get'])) {
//    var_dump(run());
//} else {
//    ?>
<!---->
<!--    <!doctype html>-->
<!--    <html lang="en">-->
<!--    <head>-->
<!--        <meta charset="UTF-8">-->
<!--        <meta name="viewport"-->
<!--              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->
<!--        <meta http-equiv="X-UA-Compatible" content="ie=edge">-->
<!--        <title>Document</title>-->
<!--        <script src="public/lib/mdb/js/jquery-3.3.1.min.js"></script>-->
<!--    </head>-->
<!--    <body>-->
<!--    <button id="btn">Run</button>-->
<!--    <div></div>-->
<!--    <script>-->
<!--        $('#btn').click(function () {-->
<!--            $.post(-->
<!--                "test.php",-->
<!--                {get: ""},-->
<!--                function (res) {-->
<!--                    $('div').append("<h1>" + res + "</h1>");-->
<!--                }-->
<!--            );-->
<!--        });-->
<!--    </script>-->
<!--    </body>-->
<!--    </html>-->
<!--    --><?php
//}
    ?>

<?php
//$file = fopen("log.log","w") or die("Cannot open file");
file_put_contents("log.log", "");
//fclose($file);
?>
