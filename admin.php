<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
require "includes/bd.php";
require "includes/input_type.php";
if(!empty($_POST)|| $_GET['status']){
    if($_POST['password']=='12345' || $_GET['status']='add'){
        echo 'Доступ получен </br>';
        echo '<a href="?status=add">Добавить новую сессию</a>';
        echo '<a href="/">Выйти</a><br>';
        if($_GET['status']=='add'){
            echo'
            <h1>Создание новой сессии</h1></br>
            <form method="post">
            <label for="theme">Выберете тему</label>
            <input type="text" id="theme" name="theme" value="'.$_POST['theme'].'"></br>
            <label for="count_questions">Выберете количество вопросов</label>
            <input type="number" id="count_questions" name="count_questions" value="'.$_POST['count_questions'].'"></br>
            ';
            if(!$_POST['count_questions']){
                echo '<input type="submit" value="Выбрать">';
            }
            if($_POST['theme']){
                echo '<h2>Тема сессии '.$_POST['theme'].'</h2>';
            }
            if(!$_POST['theme0']) {
                for ($i = 0; $i < $_POST['count_questions']; $i++) {
                    echo '
                <label for="question' . $i . '">Вопрос №' . $i . '</label>
                <select name="theme' . $i . '" id="theme' . $i . '">
                    <option value="number">Число</option>
                    <option value="positive_number">Положительно число</option>
                    <option value="small_text">строка</option>
                    <option value="big_text">текст</option>
                    <option value="radio">С единственным выбором</option>
                    <option value="checkbox">С множественным выбором</option>
                </select>
                <br>
                ';
                }
            }
            //                <input type="text" id="question'.$i.'" required>
            if($_POST['count_questions'] && !$_POST['theme0']){
                echo '<input type="submit" value="Выбрать типы вопросов">';
                print_r($_POST);
            }
            if($_POST['count_questions'] && $_POST['theme0']){
                for ($i = 0; $i < $_POST['count_questions']; $i++){
                   echo '<label for="theme">Вопрос№' . $i . ': </label>
                            <input type="text" id="question'.$i.'"  name="question'.$i.'"required>';
                   echo '<label for="theme">Ответ: </label>
                            <input '.get_type($_POST['theme'.$i]).'>';
                }
                echo '
                <input name="session_link" id="session_link" type="text"><label for="session_link">Ссылка на сессию</label>
                <input type="submit" value="Создать сессию">';
            }
            if($_POST['theme']){
                if(!$_POST['session_link']){
                $session_link = bin2hex(random_bytes(10));
                }else{
                    $session_link=$_POST['session_link'];
                }
//                $newSession="CREATE TABLE `std_924.".".".$session_link."`";
            }
            echo '</form>';
        }
    }else{
        echo 'До связи...';
    }
}else{
    echo '<form action="admin.php" method="post">
    <p>Введите пароль для доступа к этой стрнице: </p><br>
    <input type="password" name="password">
    <input type="submit">
    </form>';
}
?>
</body>
</html>