<?php require "includes/bd.php"; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Комков Дмитрий 191-322</title>
</head>
<body>
    <div class="container">
        <?php
        $get_link ="SELECT * FROM `sessions` WHERE `session_link`= '".$_GET['link']."'";
        $result = mysqli_query($link, $get_link) or die("Ошибка " . mysqli_error($link));
        if(mysqli_num_rows($result)!=0){
            echo '<h1>Опрос на тему "Вставить текст"</h1>
        <form action="/" method="post">
        <label for="question"></label><input type="text" id="question">
        </form>';
        }else{
            echo '<h1>Неккоректная ссылка</h1>';
        }
        ?>
    </div>
    <?php
    $query ="SELECT * FROM `sessions`";

    while($row = mysqli_fetch_row($result)){

        echo $row[0];
    }
    mysqli_close($link);
    ?>
</body>
</html>
