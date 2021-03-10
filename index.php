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
<!--"DELETE FROM `sessions` WHERE `sessions`.`session_link` = \'fca577f58e\'"-->
<body>
<div class="container">
    <a href="http://php-exam.std-924.ist.mospolytech.ru/?link=125243fa5f">Ссылка на сессию</a>
    <a href="admin.php">Зайти от имени администратора</a>
    <?php
    $get_link = "SELECT * FROM `sessions` WHERE `session_link`= '" . $_GET['link'] . "'";
    $result = mysqli_query($link, $get_link) or die("Ошибка " . mysqli_error($link));
    if (mysqli_num_rows($result) != 0) {
        $session = mysqli_fetch_row($result);
        if ($_SESSION['password'] == '12345') {
            echo "<a href='index.php?link=" . $_GET['link'] . "&disable'>Закрыть сессию</a><br>";
            echo "<a href='index.php?link=" . $_GET['link'] . "&delete'>Удалить сессию сессию</a><br>";
            if (isset($_GET['disable'])) {
                $update_query = "UPDATE `sessions` SET `session_status` = 'disabled' WHERE `session_link`='" . $_GET['link'] . "'";
                $update = mysqli_query($link, $update_query) or die("Ошибка " . mysqli_error($link));
                if ($session[1] == 'active') header("Refresh:1");
            }
            if (isset($_GET['delete'])) {
                $update_query = "DELETE FROM `sessions` WHERE `session_link`='" . $_GET['link'] . "'";
                $update = mysqli_query($link, $update_query) or die("Ошибка " . mysqli_error($link));
                header("Refresh:0;url=index.php");
            }
        }
        echo '<h1>Опрос на тему "' . $session[2] . '"</h1>
            <form action="/?link=' . $_GET['link'] . '" method="post">';

        if ($session[1] == 'active') {
            $questions = utf8_encode($session[3]);
            $questions = json_decode($session[3], true);
            foreach ($questions as $key => $question) {
                if ($question['type'] != 'checkbox' && $question['type'] != 'radio') {
                    echo '<label for="question' . $key . '">' . $question['question'] . '</label><br>';
                    echo '<input id="question' . $key . '" name="question' . $key . '" ' . get_type($question['type']) . '>' . $question[$question] . '</input><br><br>';
                } else {
                    echo '<p>' . $question['question'] . '</p>';
                    $radio = explode(',', $question['options']);
                    if ($question['type'] == 'radio') {
                        foreach ($radio as $num => $value) {
                            echo '<input ' . get_type($question['type']) . ' id="question' . $key . $num . '" name="question' . $key . '" value="' . $value . '">';
                            echo '<label for="question' . $key . $num . '">' . $value . '</label><br><br>';
                        }
                    } else {
                        foreach ($radio as $num => $value) {
                            echo '<input ' . get_type($question['type']) . ' id="question' . $key . $num . '" name="question' . $key . '[]" value="' . $value . '">';
                            echo '<label for="question' . $key . $num . '">' . $value . '</label><br><br>';
                        }
                    }
                }
            }
        } else {
            echo '<h2>Сессия закрыта</h2>';

        }
        echo '<input type="submit" value="Отправить">';
    } else {
        echo '<h1>Некорректная ссылка</h1>';
    }
    ?>
</div>
<?php
if (!empty($_POST)) {
    $answers_count = count($questions);
    $answers = Array();
    for ($i = 0; $i < $answers_count; $i++) {
        $answers[$i]['type'] = $questions[$i]['type'];
        is_array($_POST['question' . $i]) ?
            $answers[$i]['answer'] = implode(",", $_POST['question' . $i]) :
            $answers[$i]['answer'] = $_POST['question' . $i];
    }
    $check_answers=$answers;
    $answers = json_encode($answers, JSON_UNESCAPED_UNICODE);
    echo $_POST['question3'];
    echo "Ответы учтены ";
    print_r($check_answers);
    $client_ip = get_ip();
    date_default_timezone_set('Europe/Moscow');
    $d = date("d.m.Y");
    $t = date("H-i:s");
    $client_date = $d . ' ' . $t;
    $client_id = bin2hex(random_bytes(5));
    $answers_query = "INSERT INTO `answers` (client_id, session_link, answers, client_ip, client_date) 
                        VALUES ('$client_id', '$session[0]', '$answers', '$client_ip', '$client_date')";
    echo $answers_query;
    $result = mysqli_query($link, $answers_query) or die("Ошибка " . mysqli_error($link));
}
function get_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

mysqli_close($link);
?>
</body>
</html>
