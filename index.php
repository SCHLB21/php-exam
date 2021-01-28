<?php
require "includes/bd.php";
require "includes/input_type.php";
session_start();
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
        <a href="http://php-exam.std-924.ist.mospolytech.ru/?link=fca577f58e">Ссылка на сессию</a>
        <a href="admin.php">Зайти от имени администратора</a>
        <?php
        $get_link ="SELECT * FROM `sessions` WHERE `session_link`= '".$_GET['link']."'";
        $result = mysqli_query($link, $get_link) or die("Ошибка " . mysqli_error($link));
        if(mysqli_num_rows($result)!=0){
            $session = mysqli_fetch_row($result);
            echo '<h1>Опрос на тему "'.$session[2].'"</h1>
            <form action="/?link='.$_GET['link'].'" method="post">';

            if($session[1]=='active'){
                $questions = json_decode($session[3], JSON_OBJECT_AS_ARRAY);
                print_r($questions);
            }else{
                echo '<h2>Сессия закрыта</h2>';

            }
//            $session = mysqli_query($link, $get_session) or die("Ошибка " . mysqli_error($link));
//            $s_row=mysqli_fetch_assoc($session);


            echo '<input type="submit" value="Отправить">';
        }else{
            echo '<h1>Некорректная ссылка</h1>';
        }
        ?>
    </div>
    <?php
    if (!empty($_POST)){
        $table_name= $_GET['post'].'answers';
        $elements="";
        foreach ($_POST AS $element){
            $elements.="'".$element."',";
        }
        $elements = mb_substr($elements, 0, -1);
        $elements = mb_substr($elements, 0, -1);
        $elements.="'";
//        print_r($_POST);

        $post_query ="INSERT INTO ".$table_name." VALUES(".$elements.")";
        $add_answer = mysqli_query($link, $post_query) or die("Ошибка " . mysqli_error($link));
        echo "Ответы учтены";
        echo "ip пользователя".$_SERVER['REMOTE_ADDR'];
    }
    mysqli_close($link);
    ?>
</body>
</html>
