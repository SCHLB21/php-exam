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
if(!empty($_POST)|| $_GET['status']='add'){
    if($_POST['password']=='12345'){
        echo 'Доступ получен </br>';
        echo '<a href="?status=add">Добавить новую сессию</a>';
        if($_GET['status']=='add'){
            echo'
            <h1>Создание новой сессии</h1></br>
            <label for="count_questions">Выберете количество вопросов</label>
            <input type="number" id="count_questions">
            
            ';
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
<script>
    var count_questions = document.getElementById('count_questions');
    for (let i =0; i< count_questions.value; i++){
        count_questions+="<input type='text'>"
    }
</script>
</body>
</html>