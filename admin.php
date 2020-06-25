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
if(!empty($_POST)){
    if($_POST['password']=='12345'){
        echo 'Доступ получен';
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