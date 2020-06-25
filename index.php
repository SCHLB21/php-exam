<?php
require "includes/bd.php";
require "includes/input_type.php";
?>
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
            echo '<h1>Опрос на тему "'.mysqli_fetch_row($result)[2].'"</h1>
            <form action="/" method="post">';
            $get_session = "SELECT * FROM `".$_GET['link']."`";
            $session = mysqli_query($link, $get_session) or die("Ошибка " . mysqli_error($link));
            $s_row=mysqli_fetch_assoc($session);
            $for = 0;
            foreach($s_row AS $key => $value){
                $for+=1;
                if($for%2==0){continue;}
                echo '<label for="'.$key.'">'.$value.'</label><input '.get_type($s_row[$key.'_type']).' required></br>';
            }
            echo '<input type="submit" value="Отправить">';
        }else{
            echo '<h1>Некорректная ссылка</h1>';
        }
        ?>
    </div>
    <?php
    mysqli_close($link);
    ?>
</body>
</html>
