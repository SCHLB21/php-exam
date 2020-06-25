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
if(!empty($_POST)|| $_GET['status']){
    if($_POST['password']=='12345' || $_GET['status']='add'){
        echo 'Доступ получен </br>';
        echo '<a href="?status=add">Добавить новую сессию</a>';
        if($_GET['status']=='add'){
            echo'
            <h1>Создание новой сессии</h1></br>
            <form method="post">
            <label for="theme">Выберете тему</label>
            <input type="text" id="theme"></br>
            <label for="count_questions">Выберете количество вопросов</label>
            <input type="number" id="count_questions" name="count_questions"></br>
            ';
            if(!$_POST['count_questions']){
                echo '<input type="submit" value="Выбрать">';
            }
            for($i=0; $i<$_POST['count_questions']; $i++){
                echo '
                <label for="question'.$i.'">Вопрос </label>
                <input type="text" id="question'.$i.'">
                <select name="" id="">
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
            if($_POST['count_questions']){
                echo '<input type="submit" value="Создать сессию">';
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