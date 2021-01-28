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
        <a href="http://php-exam.std-924.ist.mospolytech.ru/?link=2UDwTZhJs7">Ссылка на сессию</a>
        <a href="admin.php">Зайти от имени администратора</a>
        <?php
        $get_link ="SELECT * FROM `sessions` WHERE `session_link`= '".$_GET['link']."'";
        $result = mysqli_query($link, $get_link) or die("Ошибка " . mysqli_error($link));
        if(mysqli_num_rows($result)!=0){
            echo '<h1>Опрос на тему "'.mysqli_fetch_row($result)[2].'"</h1>
            <form action="/?post='.$_GET['link'].'" method="post">';
            $get_session = "SELECT * FROM `".$_GET['link']."`";
            $session = mysqli_query($link, $get_session) or die("Ошибка " . mysqli_error($link));
            $s_row=mysqli_fetch_assoc($session);
            $for = 0;
            foreach($s_row AS $key => $value){
                $for+=1;
                if($for%2==0){continue;}
                if($s_row[$key.'_type']!='checkbox' && $s_row[$key.'_type']!='radio') {
                    echo '<label for="' . $key . '">' . $value . '</label><input ' . get_type($s_row[$key . '_type']) .'name="'.$key. '" required></br>';
                }elseif ($s_row[$key.'_type']=='radio'){
                    $radio = explode(",", $value);
                    $count_radio=0;
                    echo '<p>Выберите ответ: </p></br>';
                    foreach ($radio AS $item){
                        echo'<label for="'.$key.$count_radio.'">'.$item.'</label>'.
                        '<input type="radio" id="'.$key.$count_radio.'" name="'.$key.'" value="'.$item.'"</br>';
                        $count_radio++;
                    }
                }elseif ($s_row[$key.'_type']=='checkbox'){
                    $checkbox = explode(",", $value);
                    $count_checkbox=0;
                    echo '<p>Выберите один или несколько вариантов: </p></br>';
                    foreach ($checkbox AS $item){
                        echo '<input type="checkbox" name="'.$key.$count_checkbox.'" value="'.$item.'">'.$item.'</br>';
                        $count_checkbox++;
                    }
                }
            }
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
