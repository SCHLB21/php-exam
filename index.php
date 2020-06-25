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
        <h1>Опрос на тему "Вставить текст"</h1>
        <form action="/" method="post">
        <label for="question"></label><input type="text" id="question">
        </form>
    </div>
</body>
</html>
<?php
$query ="SELECT * FROM `table_name`";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
while($row = mysqli_fetch_row($result)){

    echo $row[0];
}
mysqli_close($link);