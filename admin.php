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
session_start();
require "includes/bd.php";
require "includes/input_type.php";
if (isset($_GET['logout'])) // если был переход по ссылке Выход
{
    unset($_SESSION['password']); // удаляем информацию о пользовател
    unset($_POST['password']);
    exit(); // дальнейшая работа скрипта излишняя
}
if(!empty($_POST)){
     $_SESSION['password']=$_POST['password'];
}
if($_SESSION['password']=='12345'||$_GET['status']){
    if($_POST['password']=='12345' || $_SESSION['password']=='12345'||$_GET['status']){
        echo 'Доступ получен </br>';
        echo '<a href="?status=add">Добавить новую сессию</a>';
        echo '<a href="admin.php?logout">Выйти</a><br>';
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
            for ($i = 0; $i < $_POST['count_questions']; $i++) {
                echo '
            <label for="theme' . $i . '">Вопрос №' . $i . '</label>
            <select name="theme' . $i . '" id="theme' . $i . '" value="'.$_POST['theme'.$i].'">
                <option value="number">Число</option>
                <option value="positive_number">Положительно число</option>
                <option value="small_text">строка</option>
                <option value="big_text">текст</option>
                <option value="radio">С единственным выбором</option>
                <option value="checkbox">С множественным выбором</option>
            </select>
            <br><br>
            ';
            }
            //                <input type="text" id="question'.$i.'" required>
            if($_POST['count_questions'] && !$_POST['theme0']){
                echo '<input type="submit" value="Выбрать типы вопросов">';
            }
            if($_POST['count_questions'] && $_POST['theme0']){
                for ($i = 0; $i < $_POST['count_questions']; $i++){
                   echo '<label for="question'.$i.'">Вопрос№' . $i . ': </label>
                            <input type="text" id="question'.$i.'"  name="question'.$i.'"required>';
                   if(!$_POST['theme'.$i]=='radio'||$_POST['theme'.$i]=='checkbox'){
                       echo '<label for="options'.$i.'">Варианты ответов: </label>
                            <input type="text" id="options'.$i.'" name="options'.$i.'" required>';
                   }
                   echo '<label for="answer'.$i.'">Ответ: </label>
                            <input type="text" id="answer'.$i.'" name="answer'.$i.'" required><br><br>';
                }
                echo '
                <input name="session_link" id="session_link" type="text"><label for="session_link">Ссылка на сессию</label>
                <input type="submit" value="Создать сессию">';
            }
            if($_POST['question0']){
                if(!$_POST['session_link']){
                $session_link = bin2hex(random_bytes(5));
                }else{
                    $session_link=$_POST['session_link'];
                }
                $questions=Array();
                for ($i = 0; $i < $_POST['count_questions']; $i++){
                    $questions[$i]['type']=$_POST['theme'.$i];
                    $questions[$i]['question']=$_POST['question'.$i];
                    if(!$_POST['theme'.$i]=='radio'||$_POST['theme'.$i]=='checkbox'){
                        $questions[$i]['options']=$_POST['options'.$i];
                    }
                    $questions[$i]['answer']=$_POST['answer'.$i];
                }
                $questions = json_encode($questions, JSON_UNESCAPED_UNICODE);
                $theme = $_POST['theme'];
                $questions_query="INSERT INTO `sessions` (session_link, session_status, theme, questions) 
                        VALUES ('$session_link', 'active', '$theme', '$questions')";
//                $newSession="CREATE TABLE `std_924.".".".$session_link."`";
                $result = mysqli_query($link, $questions_query) or die("Ошибка " . mysqli_error($link));
                unset($_POST);
//                echo $questions_query;
            }
            echo '</form>';
        }
    }else{
        echo 'До связи...';
    }
}else{
    print_r($_SESSION['password']);
    echo '<form action="admin.php" method="post">
    <p>Введите пароль для доступа к этой стрнице: </p><br>
    <input type="password" name="password">
    <input type="submit">
    </form>';
}
?>
<script src="main.js"></script>
</body>
</html>