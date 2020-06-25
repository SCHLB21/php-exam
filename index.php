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
//    if ($_POST[]){
//        echo 'ПРИВЕТТТТ';
//        echo 'ПРИВЕТТТТ';
//        echo 'ПРИВЕТТТТ';
//    }
    mysqli_close($link);
    ?>
</body>
</html>
